<?php
/**
 * Created by SergeyBondarchuk.
 * 23.04.2018 20:13
 */

namespace SphereMall\MS\Lib\Mappers;


use SphereMall\MS\Entities\WebSite;

class WebSitesMapper extends Mapper
{
    protected function doCreateObject(array $array)
    {
        $webSite = new WebSite($array);

        if (isset($array['webSiteSettings'])) {
            $settingsMapper = new WebSiteSettingsMapper();
            foreach ($array['webSiteSettings'] as $webSiteLanguage) {
                $webSite->settings[] = $settingsMapper->createObject($webSiteLanguage);
            }
        }

        if (isset($array['webSiteLanguages'])) {
            $languagesMapper = new WebSiteLanguagesMapper();
            foreach ($array['webSiteLanguages'] as $webSiteLanguage) {
                $webSite->languages[] = $languagesMapper->createObject($webSiteLanguage);
            }
        }

        return $webSite;
    }
}