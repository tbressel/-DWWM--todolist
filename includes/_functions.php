<?php
/**
 * Return the current page name including its path
 *
 * @return string
 */
function getCurrentPageName(): string
{
    return  basename($_SERVER['SCRIPT_NAME']);
}


/**
 * Get array from data for current page data
 *
 * @param array $pages
 * @return array
 */
function getCurrentPageData(array $pages): ?array
{
    // foreach($pages as $page){
    //     if($page['file'] === getCurrentPageName()){
    //        return $page;
    //     }
    // }
    // return NULL;

    return current(array_filter($pages, fn ($p) => $p['file'] === getCurrentPageName()));
}

/**
 * Generate style sheet links
 *
 * @param array $styleSheetFiles
 * @return string
 */
function generateStyleSheetLinks(array $styleSheetFiles): string
{
    return implode('', array_map(fn ($cssFile) => "<link rel=\"stylesheet\" href=\"{$cssFile}\">", $styleSheetFiles));
}


function getLanguageType(array $pages): string 
{
    return $lang = implode("", array_column($pages,'language'));

};




