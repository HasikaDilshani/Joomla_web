<?php
/**
 * @version    $Id$
 * @package    SUN Framework
 * @author     JoomlaShine Team <support@joomlashine.com>
 * @copyright  Copyright (C) 2016 JoomlaShine.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Websites: http://www.joomlashine.com
 * Technical Support:  Feedback - http://www.joomlashine.com/contact-us/get-support.html
 */

// No direct access to this file.

defined('_JEXEC') or die('Restricted access');
if ( ! function_exists('sunFwLoader'))
{
	// Define base constants for the framework
	if ( ! defined('JSN_PATH_SUNFW_FRAMEWORK_INSTALLER'))
	{
		define('JSN_PATH_SUNFW_FRAMEWORK_INSTALLER', dirname(__FILE__));
	}

	// Define base constants for the framework
	if ( ! defined('JSN_PATH_SUNFW_FRAMEWORK_LIBRARIES_INSTALLER'))
	{
		define('JSN_PATH_SUNFW_FRAMEWORK_LIBRARIES_INSTALLER', JSN_PATH_SUNFW_FRAMEWORK_INSTALLER . '/libraries/joomlashine');
	}

	// Import class loader
	require_once JSN_PATH_SUNFW_FRAMEWORK_LIBRARIES_INSTALLER . '/loader.php';
}

// Import necessary Joomla libraries
jimport('joomla.filesystem.folder');
jimport('joomla.filesystem.file');

// Load HTTP Request library if there is an older version of SunFw framework installed
if ( ! class_exists('SunFwHttpRequest'))
{
	require_once dirname(__FILE__) . '/libraries/joomlashine/http/request.php';
}

/**
 * Installer class.
 *
 * @package  SUN Framework
 * @since    1.0.0
 */
class PlgSystemSunFwInstallerScript
{
	/**
	 * Template framework installation state.
	 *
	 * @var  boolean
	 */
	public static $sunFwInstalled = false;

	/**
	 * @var JApllication
	 */
	private static $_app;

	/**
	 * @var JDatabase
	 */
	private static $_dbo;

	/**
	 * @var JInstaller
	 */
	private static $_installer;

	/**
	 * @var SimpleXMLDocument
	 */
	private static $_manifest;

	/**
	 * @var string
	 */
	private static $_installPath;

	/**
	 * @var array
	 */
	private static $_manifestCache = array();

	/**
	 * @var string
	 */
	private static $_templateName;

	/**
	 * URL to download template framework
	 * @var string
	 */
	private $_frameworkUrl = 'https://www.joomlashine.com/index.php?option=com_lightcart&controller=remoteconnectauthentication&task=authenticate&tmpl=component&identified_name=tpl_sunframework&upgrade=yes&joomla_version=3.0';

	/**
	 * Implement preflight hook.
	 *
	 * This step will be verify permission for install/update process.
	 *
	 * @param   string  $mode    Install or update?
	 * @param   object  $parent  JInstaller object.
	 *
	 * @return  boolean
	 */
	public function preflight ($mode, $parent)
	{
		// Uninstall a template does not need pre-flight hook
		if ($mode == 'uninstall')
		{
			return true;
		}
		
		$app 			= JFactory::getApplication();
		$jVersion		= new JVersion;
		$jShortVersion 	= $jVersion->getShortVersion();
		
		if (version_compare($jShortVersion, '3.5.0', '<'))
		{	
			$app->enqueueMessage("You're running an outdated Joomla version. Please upgrade your Joomla to the latest version, or at least version 3.5, before installing the template.", 'error');
			return false;			
		}
		
		try
		{
			// Initialize necessary variables
			self::$_app				= JFactory::getApplication();
			self::$_dbo				= JFactory::getDBO();
			self::$_installer		= $parent->getParent();
			self::$_manifest		= self::$_installer->getManifest();
			self::$_installPath		= self::$_installer->getPath('source');
			self::$_templateName	= (string) self::$_manifest->template;
			self::$sunFwInstalled	= $this->_isInstalled('sunfw');

			if ($this->_checkPermission())
			{
				// Checking template installation
				if ($this->_isInstalled(self::$_templateName))
				{
					$this->_backupModifiedFiles(self::$_templateName);
					$this->_backupTemplateManifestData(self::$_templateName);
				}

				// Checking framework installation
				if (self::$sunFwInstalled)
				{
					// Backup installed version of template framework
					JFolder::copy(JPATH_ROOT . '/plugins/system/sunfw', self::$_installPath . '/backups', '', true);
				}
			}
		}
		catch (Exception $ex)
		{
			self::$_app->enqueueMessage(JText::_($ex->getMessage()), 'error');

			return false;
		}
	}

	/**
	 * Implement postflight hook
	 *
	 * @param   string  $mode    Install or update?
	 * @param   object  $parent  JInstaller object.
	 *
	 * @return  boolean
	 */
	public function postflight ($mode, $parent)
	{
		if ($mode == 'uninstall') {
			return true;
		}

		try
		{
			// Download framework package and extract it to plugin folder
			$this->_installFramework();

			// Install template after extracted framework package
			$this->_installTemplate();
			$this->_cleanup(JPATH_ROOT . '/templates/' . self::$_templateName);

			//Customer custom.css file
			$this->_createCustomCssFile(self::$_templateName);

			// Active template framework plugin and set it to protected
			self::$_dbo->setQuery("UPDATE #__extensions SET enabled=1, protected=1, ordering=9999 WHERE element LIKE 'sunfw' LIMIT 1");

			method_exists(self::$_dbo, 'execute') ? self::$_dbo->execute() : self::$_dbo->query();

			// Check template framework installation state
			if ( ! self::$sunFwInstalled)
			{
				self::$_app->enqueueMessage(JText::_('PLG_SYSTEM_SUNFW_ERROR_CANNOT_DOWNLOAD_FRAMEWORK_PACKAGE'));
			}

			if (in_array($mode, array('install', 'discover_install', 'update')))
			{
				$language = JFactory::getLanguage();
				$language->load( 'tpl_' . self::$_templateName, JPATH_ROOT );

				$this->pathOnly 			= JURI::root(true);
				$this->pathRoot 			= JURI::root();
				$this->parentInstaller 		= $parent->getParent();
				$this->style 				= $this->getTemplateStyleByName(self::$_templateName);
				$this->templateName 		= (string) self::$_templateName;

				$templateManifest 			= simplexml_load_file($this->parentInstaller->getPath('source') . '/template/templateDetails.xml');
				$this->templateVersion 		= (string) (string) $templateManifest->version;
				$this->identifiedName		= (string) (string) $templateManifest->identifiedName;

				try
				{
					ob_start();
					include_once $this->parentInstaller->getPath('source') . '/template/install/templates/install.html.php';
					$html	= ob_get_contents();
					ob_end_clean();
					echo $html;
				}
				catch (Exception $e)
				{

				}
			}
		}
		catch (Exception $ex)
		{
			die($ex->getMessage());
		}
	}

	/**
	 * This method use to validate folder permission before
	 * start installation process
	 *
	 * @return  boolean
	 */
	private function _checkPermission ()
	{
		// Skip checking for folder permission if FTP Layer is enabled
		$config = JFactory::getConfig();

		if ($config->get('ftp_enable'))
		{
			return true;
		}

		// List of path that will scan all language folder
		$languageFolders = array(
			self::$_installPath . '/language',
			self::$_installPath . '/template/language',
		);

		// Variable to store all supported languages
		$supportedLanguages = array();

		// Scan folder to get language list
		foreach ($languageFolders AS $path)
		{
			// Find all folder in the path
			foreach (glob($path . '/*', GLOB_ONLYDIR) AS $languagePath)
			{
				$supportedLanguages[] = basename($languagePath);
			}
		}

		// Filter to give unique folder name
		$supportedLanguages = array_unique($supportedLanguages);

		// Check folder permissions
		$canInstallTemplate	= is_writable(JPATH_ROOT . '/templates');
		$canInstallPlugin	= is_writable(JPATH_ROOT . '/plugins/system');
		$canInstallLanguage	= is_writable(JPATH_ROOT . '/language');

		// Variable to store all unwritable paths
		$unwritablePaths = array();

		// Check permission for each language code
		foreach ($supportedLanguages as $languageCode)
		{
			$languagePath = JPATH_ROOT . '/language/' . $languageCode;

			// Check write permission for language path
			if (is_dir($languagePath) && !is_writable($languagePath))
			{
				$unwritablePaths[]	= $languagePath;
				$canInstallLanguage	= false;
			}
		}

		// Enqueue error message for plugin path
		$canInstallPlugin OR self::$_app->enqueueMessage(JText::_('PLG_SYSTEM_SUNFW_ERROR_PLUGIN_FOLDER_PERMISSION'), 'error');

		// Enqueue error message for template path
		$canInstallTemplate OR self::$_app->enqueueMessage(JText::_('PLG_SYSTEM_SUNFW_ERROR_TEMPLATE_FOLDER_PERMISSION'), 'error');

		// Enqueue error message for language path
		$canInstallLanguage OR self::$_app->enqueueMessage(JText::_('PLG_SYSTEM_SUNFW_ERROR_LANGUAGE_FOLDER_PERMISSION'), 'error');

		// Enqueue error message for language code path
		foreach ($unwritablePaths AS $path)
		{
			self::$_app->enqueueMessage(JText::sprintf('PLG_SYSTEM_SUNFW_ERROR_UNWRITABLE_PATH', $path), 'error');
		}

		return $canInstallPlugin && $canInstallLanguage && $canInstallTemplate;
	}

	/**
	 * Checking files modification for installed template
	 *
	 * @return  void
	 */
	public function _backupModifiedFiles ($templateName)
	{
		$modifiedFiles = SunFwHelper::getModifiedFiles($templateName);

		if (!empty($modifiedFiles['edit'])) {
			// Create temporary folder for store backup files
			$config		= JFactory::getConfig();
			$tmpPath	= $config->get('tmp_path');
			$backupPath = $tmpPath . "/{$templateName}_backup";
			$backupUrl  = JURI::root(true) . '/tmp/' . $templateName . '_backup.zip';

			$templatePath = JPATH_ROOT . "/templates/{$templateName}";

			if (!is_dir($backupPath)) {
				JFolder::create($backupPath);
			}

			$files = array();

			// Copy all modified files to backup folder
			foreach ($modifiedFiles['edit'] as $file) {
				if (strpos($file, '/') === false && strpos($file, '\\') === false) {
					$path = $backupPath;
				}
				else {
					$filePath = dirname($file);
					$path = "{$backupPath}/{$filePath}";
				}

				SunFwHelper::makePath($path);
				JFile::copy("{$templatePath}/{$file}", "{$backupPath}/{$file}");

				$files[] = array(
					'name' => $file,
					'data' => file_get_contents("{$backupPath}/{$file}")
				);
			}

			$archiver = new SunFwArchiveZip();
			$archiver->create($backupPath . '.zip', $files);

			$this->_hasBackupFiles = true;
		}
	}

	/**
	 * Retrieve cached manifest data from database for an
	 * extension
	 *
	 * @param   string  $name  Name of the extension to load manifest
	 *
	 * @return  object
	 */
	private function _getMenifestCache ($name)
	{
		if (!isset(self::$_manifestCache[$name]) || self::$_manifestCache[$name] == null)
		{
			$query = self::$_dbo->getQuery(true);
			$query->select('manifest_cache')
				->from('#__extensions')
				->where('element LIKE \'' . self::$_dbo->escape($name) . '\'');
			self::$_dbo->setQuery($query);

			// Fetch manifest cache from database
			$result = self::$_dbo->loadResult();

			// Save loaded data to memory
			self::$_manifestCache[$name] = json_decode($result);
		}

		return self::$_manifestCache[$name];
	}

	/**
	 * Install template to the joomla system
	 *
	 * @return void
	 */
	private function _installTemplate ()
	{
		// Find all template inside templates folder and install it
		$templateInstaller = new JInstaller();
		$result = $templateInstaller->install(self::$_installPath . '/template');

		if ($result)
		{
			$executeMethod = method_exists(self::$_dbo, 'query') ? 'query' : 'execute';
			$templateName  = self::$_templateName;

			// Clean template cache
			$cacheDir = JPATH_ROOT . '/tmp/' . $templateName;

			if (is_dir($cacheDir)) {
				jimport('joomla.filesystem.folder');
				JFolder::delete($cacheDir);
			}

			// Update installed template to jsntemplate group
			self::$_dbo->setQuery("UPDATE #__extensions SET custom_data='sunfw' WHERE element='{$templateName}' AND type='template'");
			self::$_dbo->{$executeMethod}();
			
			$rCheckExisted = $this->getTemplateStyleByName(self::$_templateName);
			if (!count((array) $rCheckExisted))
			{
				// Make other template to not default
				self::$_dbo->setQuery("UPDATE #__template_styles SET home=0 WHERE client_id=0 AND home=1 LIMIT 1");
				self::$_dbo->{$executeMethod}();

				// Make installed template to default
				self::$_dbo->setQuery("UPDATE #__template_styles SET home=1 WHERE template LIKE '{$templateName}' LIMIT 1");
				self::$_dbo->{$executeMethod}();
			}

			self::$_app->enqueueMessage(JText::sprintf('PLG_SYSTEM_SUNFW_INSTALLED_TEMPLATE', JText::_(self::$_templateName)));
			self::$_installer->set('message', $templateInstaller->get('message'));

			if (isset($this->_hasBackupFiles) && $this->_hasBackupFiles == true)
			{
				// Create temporary folder for store backup files
				$config		= JFactory::getConfig();
				$tmpPath	= $config->get('tmp_path');
				$backupPath = $tmpPath . "/{$templateName}_backup.zip";
				$templateBackupPath = JPATH_ROOT . "/templates/{$templateName}/backups";

				if ( ! is_dir($templateBackupPath))
				{
					JFolder::create($templateBackupPath);
				}

				// Copy backup file to template folder
				JFile::copy($backupPath, $templateBackupPath . '/' . date('y-m-d') . '.zip');
			}

			//Re update positions that created by customer
			if (isset($this->_oldTemplateManifest))
			{
				try
				{
					$this->_reUpdatePosition($templateName);
				}
				catch (Exception $e)
				{

				}
			}
		}
	}

	/**
	 * Clean up files from old version
	 *
	 * @param  string  $path  Path to template directory
	 *
	 * @return void
	 */
	private function _cleanup ($path)
	{
		foreach (array('admin', 'elements', 'includes') as $name)
			if (JFolder::exists($path . '/' . $name))
				JFolder::delete($path . '/' . $name);

		foreach (glob($path . '/*.php') AS $file)
		{
			if (preg_match('/^jsn_/i', basename($file)))
			{
				JFile::delete($file);
			}
		}
	}

	/**
	 * Download framework package from Joomlashine server and
	 * install to Joomla system
	 *
	 * @return void
	 */
	private function _installFramework ()
	{
		if (@is_file(self::$_installPath . '/backups/sunfw.xml'))
		{
			$frameworkXml = simplexml_load_file(self::$_installPath . '/backups/sunfw.xml');
			$frameworkVersion = (string) $frameworkXml->version;

			// Check if template framework is up to date
			$this->_getLatestFrameworkVersion();

			if (empty($this->latest) || version_compare($frameworkVersion, $this->latest, '>='))
			{
				// Restore backup-ed template framework
				JFolder::copy(self::$_installPath . '/backups', JPATH_ROOT . '/plugins/system/sunfw', '', true);

				// Update framework version
				$this->_updateFrameworkVersion($frameworkVersion);

				// State that template framework is installed
				self::$sunFwInstalled = true;

				return;
			}
		}

		// Set time limit to zero will avoid error "Maximum execution time" when downloading template framework
		set_time_limit(0);

		try
		{
			// Download template framework from JoomlaShine server
			$downloadResult = SunFwHttpRequest::get($this->_frameworkUrl, self::$_installPath . '/framework.zip');

			// Check download response headers
			if ($downloadResult['header']['content-type'] == 'application/zip')
			{
				// Unpack downloaded file and install it
				$frameworkUnpacked = JInstallerHelper::unpack(self::$_installPath . '/framework.zip');

				// Copy framework files to plugin folder
				JFolder::copy($frameworkUnpacked['dir'], JPATH_ROOT . '/plugins/system/sunfw', '', true);

				// Copy language files
				JFolder::copy($frameworkUnpacked['dir'] . '/language', JPATH_ADMINISTRATOR . '/language', '', true);

				// Parse manifest file for just installed framework version
				$frameworkXml = simplexml_load_file(JPATH_ROOT . '/plugins/system/sunfw/sunfw.xml');
				$frameworkVersion = (string) $frameworkXml->version;

				// Update framework version
				$this->_updateFrameworkVersion($frameworkVersion);

				// Enqueue message
				self::$_app->enqueueMessage(JText::_('PLG_SYSTEM_SUNFW_INSTALLED_FRAMEWORK'));

				// State that template framework is installed
				self::$sunFwInstalled = true;
			}
		}
		catch (Exception $e)
		{

		}
	}

	/**
	 * Update version number of template framework in
	 * manifest cache
	 *
	 * @param   string  $version  Version number to be updated
	 *
	 * @return  void
	 */
	private function _updateFrameworkVersion ($version)
	{
		$executeMethod = method_exists(self::$_dbo, 'query') ? 'query' : 'execute';

		$query = self::$_dbo->getQuery(true);
		$query->select('manifest_cache')
			->from('#__extensions')
			->where('element=\'sunfw\'');

		self::$_dbo->setQuery($query);
		$manifestCache = json_decode(self::$_dbo->loadResult());
		$manifestCache->version = $version;

		self::$_dbo->setQuery("UPDATE #__extensions SET manifest_cache=" . self::$_dbo->quote(json_encode($manifestCache)) . " WHERE element='sunfw'");
		self::$_dbo->{$executeMethod}();
	}

	/**
	 * Check an extension is installed to joomla system
	 *
	 * @param   string  $name  Name of the extension
	 *
	 * @return  boolean
	 */
	private function _isInstalled ($name)
	{
		$query = self::$_dbo->getQuery(true);
		$query->select('COUNT(*)')
			->from('#__extensions')
			->where('element LIKE \'' . self::$_dbo->escape($name) . '\'');
		self::$_dbo->setQuery($query);

		return intval(self::$_dbo->loadResult()) > 0;
	}

	/**
	 * Get latest framework version.
	 *
	 * @return  string
	 */
	private function _getLatestFrameworkVersion()
	{
		if ( ! isset($this->latest))
		{
			$this->latest = null;

			try
			{
				// Establish an internet connection to JoomlaShine server to get latest framework version
				$response = SunFwHttpRequest::get('https://www.joomlashine.com/versioning/product_version.php?category=cat_template');
				$data = json_decode($response['body']);

				foreach ($data->items AS $product)
				{
					if ($product->identified_name == 'tpl_sunframework')
					{
						$this->latest = $product->version;

						break;
					}
				}
			}
			catch (Exception $e)
			{
				// Do nothing
			}
		}
	}

	/**
	 * Back old template manifest data
	 *
	 * @param string $name	the template name
	 *
	 * @return void
	 */
	private function _backupTemplateManifestData($name)
	{
		$this->_oldTemplateManifest = simplexml_load_file(JPATH_ROOT . '/templates/' . $name . '/templateDetails.xml');
	}

	/**
	 * Update postions that created by user
	 *
	 * @param string $templateName	the template name
	 * @throws Exception
	 * @return boolean
	 */
	private function _reUpdatePosition($templateName)
	{
		if (isset($this->_oldTemplateManifest))
		{
			$positions = array();

			foreach ( $this->_oldTemplateManifest->xpath( 'positions/position' ) as $pos )
			{
				$positions [] = (string) $pos;
			}

			if (!count($positions)) return false;

			$manifestPath = JPATH_ROOT . '/templates/' . $templateName . '/templateDetails.xml';

			// Prepare template's manifest file.
			$file = JPath::clean( $manifestPath );

			if ( ! is_writable( $file ) )
			{
				// Try to change ownership of the file.
				$user = get_current_user();

				chown( $file, $user );

				if ( ! JPath::setPermissions( $file, '0644' ) )
				{
					throw new Exception( JText::sprintf('PLG_SYSTEM_SUNFW_FILE_NOT_WRITABLE', 'templateDetails.xml') );
				}

				if ( ! JPath::isOwner( $file ) )
				{
					throw new Exception( JText::_('PLG_SYSTEM_SUNFW_CHECK_FILE_OWNERSHIP') );
				}
			}

			// Parse XML data from manifest file.
			$manifest = simplexml_load_file( $file );

			foreach ( $manifest->xpath( 'positions/position' ) as $pos )
			{
				if ( in_array(( string ) $pos, $positions))
				{
					//throw new Exception( JText::_('SUNFW_POSITION_IS_EXISTED') );
					$positions = array_diff($positions, array(( string ) $pos));
				}
			}

			if (count($positions))
			{
				foreach($positions as $position)
				{
					$manifest->positions->addChild( 'position', $position );
				}
			}

			$manifest = $manifest->asXML();

			if ( ! JFile::write( $file, $manifest ) )
			{
				throw new Exception( JText::sprintf('PLG_SYSTEM_SUNFW_ERROR_FAILED_TO_SAVE_FILENAME', 'templateDetails.xml') );
			}
		}

		return true;
	}

	/**
	 * Auto create custom.css file in css/custom for template
	 *
	 * @param string $templateName the template name
	 * @return boolean
	 */
	private function _createCustomCssFile($templateName)
	{
		$customFolder 	= JPATH_ROOT . '/templates/' . $templateName . '/css/custom';
		$customFile		= $customFolder . "/custom.css";

		$content 		= "/* Write your custom css code here */";
		if (!JFolder::exists($customFolder))
		{
			$rc = JFolder::create($customFolder);
			if ($rc)
			{
				$rw = JFile::write($customFile, $content);
				if ($rw)
				{
					$this->_addCustomCssFileChecksum($customFile, $templateName);
					return true;
				}
			}
		}
		else
		{
			if (!JFile::exists($customFile))
			{
				$rw = JFile::write($customFile, $content);
				if ($rw)
				{
					$this->_addCustomCssFileChecksum($customFile, $templateName);
					return true;
				}
			}
		}

		return false;
	}

	/**
	 *
	 * @param string $file				the custom file path
	 * @param unknown $templateName		the template name
	 * @return boolean
	 */
	private function _addCustomCssFileChecksum($file, $templateName)
	{
		$dbo = JFactory::getDbo();
		$q   = $dbo->getQuery( true );

		$q
		->select( 'params' )
		->from( '#__extensions' )
		->where( 'type = ' . $q->quote( 'template' ) )
		->where( 'element = ' . $q->quote( $templateName ) );
		$dbo->setQuery( $q );

		try
		{
			if ( ! ( $params = json_decode( $dbo->loadResult(), true ) ) )
			{
				$params = array();
			}
		}
		catch (Exception $e)
		{
			return false;
		}

		$params = array_merge($params, array('customCSSFileChecksum' => md5_file($file)));

		// Store to database.
		$q   = $dbo->getQuery( true );
		$q
		->update( '#__extensions' )
		->set( 'params = ' . $q->quote( json_encode( $params ) ) )
		->where( 'type = ' . $q->quote( 'template' ) )
		->where( 'element = ' . $q->quote( $templateName ) );
		$dbo->setQuery( $q );

		try
		{
			return $dbo->execute();
		}
		catch (Exception $e)
		{
			return false;
		}
	}

	/**
	 * Get Template Home By Name
	 *
	 * @param string $template	Template name
	 *
	 * @return (object)
	 */
	public function getTemplateStyleByName( $template )
	{
		$db = JFactory::getDbo();
		$q  = $db->getQuery( true );
		$q->clear();
		$q
			->select( '*' )
			->from( $db->quoteName( '#__template_styles' ) )
			->where( $db->quoteName('client_id') . ' = 0' )
			->where( $db->quoteName('home') . ' = 1' )
			->where( $db->quoteName('template') . ' = ' . $db->quote( $template ) );

		$db->setQuery( $q );

		try
		{
			$styles = $db->loadObject();
		}
		catch ( Exception $e )
		{
			return false;
		}

		return $styles;
	}
}
