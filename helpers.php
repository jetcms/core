<?php

if (!function_exists('image_thumb_fit')) {
    /**
     * Adds one or more messages to the MessagesCollector
     *
     * @param  mixed ...$value
     * @return string
     */
    function image_thumb_fit($nameFile,$w,$h = null)
    {

        if ( !is_file( public_path($nameFile) ) ) return null;
        if (!is_dir(public_path('thumb'))) {
            mkdir(public_path('thumb'));
        }
        $pathFile = 'thumb/t'.md5($nameFile).'('.$h.'-'.$w.').png';
        if (!file_exists(public_path($pathFile))){
            Image::make(public_path($nameFile))
                ->fit($w,$h)
                ->encode('png', 95)
                ->save(public_path($pathFile),100);
        }
        return $pathFile;

    }
}
if (!function_exists('image_thumb_resize_canvas')) {

    /**
     * @param $nameFile
     * @param $w
     * @param null $h
     * @param string $position
     * @param string $color
     * @return null|string
     */
    function image_thumb_resize_canvas($nameFile, $w, $h = null, $position = 'center', $color = 'fff')
    {
        if (!is_file(public_path($nameFile))) return config('jetcms.core.not_image',null);
        if (!is_dir(public_path('thumb'))) {
            mkdir(public_path('thumb'));
        }

        $pathFile = 'thumb/t' . md5($nameFile) . '(' . $h . '-' . $w . '-' . $position . '-' . $color . ').png';
        if (!file_exists(public_path($pathFile))) {
            Image::make(public_path($nameFile))->resize($w, $h, function ($constraint) {
                $constraint->aspectRatio();
            })->resizeCanvas($w, $h, $position, false, $color)->encode('png', 95)->save(public_path($pathFile), 100);
        }

        return $pathFile;
    }
}

if (!function_exists('html_minify')) {


    /**
     * @param $view
     * @return mixed
     */
    function html_minify($view)
    {
        //return $view;
        return preg_replace(array('/<!--.*?-->|\t|(?:\r?\n[ \t]*)+/s'), array(''), $view);
        //return gzencode($view);
    }
}

if (!function_exists('words_limit')) {

    /**
     * @param $input_text
     * @param int $limit
     * @return string
     */
    function words_limit($input_text, $limit = 50)
    {
        $input_text = strip_tags($input_text);
        $words = explode(' ', $input_text); // создаём из строки массив слов
        if ($limit < 1 || sizeof($words) <= $limit) { // если лимит указан не верно или количество слов меньше лимита, то возвращаем исходную строку
            return $input_text;
        }
        $words = array_slice($words, 0, $limit); // укорачиваем массив до нужной длины
        $out = implode(' ', $words);
        return $out; //возвращаем строку + символ/строка завершения
    }
}