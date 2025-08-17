<?php

namespace Core\View;

use Core\Log\Error;

class View
{
    public static function make(string $template, array $data = []): void
    {
        $template = str_replace('.' , '/' , $template);
        $templatePath = dirname(__DIR__, 2) . '/views/' . $template . '.view.php';
        if (!file_exists($templatePath)) {
            Error::show("view not find $template", true);
        }

        $content = file_get_contents($templatePath);

        $content = self::applyLayout($content);
        $parsed = self::parseCustomTags($content);

        extract($data);
        $tmp = sys_get_temp_dir() . '/view_' . md5($parsed) . '.php';
        file_put_contents($tmp, $parsed);

        include $tmp;
        unlink($tmp);
    }

    private static function parseCustomTags(string $content): string
    {
        $content = preg_replace_callback('/<print\s+value="([^"]+)">/', fn($m) => "<?= htmlspecialchars({$m[1]} ?? '' )  ?>", $content);

        $content = preg_replace_callback('/<if\s+condition="([^"]+)">/', fn($m) => "<?php if ({$m[1]}): ?>", $content);
        $content = str_replace('<else>', '<?php else: ?>', $content);
        $content = str_replace('</if>', '<?php endif; ?>', $content);

        $content = preg_replace_callback('/<foreach\s+loop="([^"]+)\s+as\s+([^"]+)">/', fn($m) => "<?php foreach ({$m[1]} as {$m[2]}): ?>", $content);
        $content = str_replace('</foreach>', '<?php endforeach; ?>', $content);

        $content = preg_replace_callback('/<for\s+expr="([^"]+)">/', fn($m) => "<?php for ({$m[1]}): ?>", $content);
        $content = str_replace('</for>', '<?php endfor; ?>', $content);

        $content = preg_replace_callback('/<while\s+condition="([^"]+)">/', fn($m) => "<?php while ({$m[1]}): ?>", $content);
        $content = str_replace('</while>', '<?php endwhile; ?>', $content);

        return $content;
    }

    private static function applyLayout(string $content): string
    {
        if (preg_match('/<layout\s+file="([^"]+)">/', $content, $match)) {
            $layoutFile = dirname(__DIR__, 2) . '/views/layouts/' . $match[1] . '.view.php';
            if (!file_exists($layoutFile)) {
                Error::show("Layout file not found: {$layoutFile}",true);
            }

            preg_match_all('/<section\s+name="([^"]+)">(.*?)<\/section>/s', $content, $sections, PREG_SET_ORDER);
            $sectionMap = [];
            foreach ($sections as $sec) {
                $sectionMap[$sec[1]] = $sec[2];
            }

            $layoutContent = file_get_contents($layoutFile);

            foreach ($sectionMap as $name => $value) {
                $layoutContent = str_replace("@yield('$name')", $value, $layoutContent);
            }

            return $layoutContent;
        }

        return $content;
    }

    private static function getViewPath(string $view): string
    {
        $relativePath = str_replace('.', '/', $view) . '.php';
        return dirname(__DIR__,1) . '/views/' . $relativePath;
    }
}