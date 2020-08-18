<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function () {
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Websedit.WeCookieConsent',
            'Pi1',
            [
                'Consent' => 'consent, list',
            ],
            [
                'Consent' => '',
            ]
        );

        if (TYPO3_MODE === 'BE') {
            /**
             * Hooks
             */
            $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][] = \Websedit\WeCookieConsent\Hook\AfterSaveHook::class;

            /**
             * Icons
             */
            $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);

            //New Content Element Wizard Icon
            $iconRegistry->registerIcon(
                'we_cookie_consent-plugin-pi1',
                $iconRegistry->detectIconProvider('user_plugin_pi1.svg'),
                [
                    'source' => 'EXT:we_cookie_consent/Resources/Public/Icons/user_plugin_pi1.svg'
                ]
            );

            //SysFolder Icon
            $iconRegistry->registerIcon(
                'pagetree-folder-contains-cookies',
                $iconRegistry->detectIconProvider('sysfolder.png'),
                [
                    'source' => 'EXT:we_cookie_consent/Resources/Public/Icons/sysfolder.png'
                ]
            );

            /**
             * ContentElementWizard for Pi1
             */
            \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
                '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:we_cookie_consent/Configuration/TSConfig/ContentElementWizard.typoscript">'
            );
        }

        // Workaround to define custom subcategories in constants editor. Doesn't work in constants.ts
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptConstants('
            # customcategory=plugin.tx_wecookieconsent_pi1=Websedit Cookie Consent
            # customsubcategory=01_WEID=IDs
            # customsubcategory=02_WETEMPLATE=Template
            # customsubcategory=03_WEOTHER=Other
        ');
    }
);