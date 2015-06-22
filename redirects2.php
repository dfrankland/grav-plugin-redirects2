<?php

namespace Grav\Plugin;

use Grav\Common\Plugin;
use Grav\Common\Page\Page;

class Redirects2Plugin extends Plugin
{
    public static function getSubscribedEvents()
    {
        return ['onPluginsInitialized' => ['onPluginsInitialized', 0]];
    }

    public function onPluginsInitialized()
    {
        if ($this->isAdmin()) {
            $this->active = false;

            return;
        }
        $this->enable(['onPageInitialized' => ['onPageInitialized', 0]]);
    }

    public function onPageInitialized()
    {
        $grav = $this->grav;
        $debugger = $grav[ 'debugger' ];
        $header = $grav[ 'page' ]->header();
        $errors = false;
        if (isset($header->redirects2)) {
            if (isset($header->redirects2[ 'status' ])) {
                $status = $header->redirects2[ 'status' ];
                if (is_numeric($status)) {
                    switch ($status) {
                        case '201':
                        case '300':
                        case '301':
                        case '302':
                        case '303':
                        case '304':
                        case '305':
                            http_response_code($status);
                            break;
                        default:
                            $debugger->addMessage('Redirects2 status is not one of 201, 300, 301, 302, 303, 304, or 305.');
                            $errors = true;
                            break;
                    }
                } else {
                    $debugger->addMessage('Redirects2 status is not a number.');
                    $errors = true;
                }
            }
            if (isset($header->redirects2[ 'url' ])) {
                $url = $header->redirects2[ 'url' ];
                if (filter_var($url, FILTER_VALIDATE_URL) && $errors !== true) {
                    header('Location: '.$url);
                    exit;
                } else {
                    $debugger->addMessage('Redirects2 url is not a valid url.');
                }
            } else {
                $debugger->addMessage('Redirects2 url not found.');
            }
        }
    }
}
