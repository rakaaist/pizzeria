<?php


namespace Core;


class View
{
    protected $data = [];

    /**
     * View constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Function allows to take take template from $template_path and returns html in string
     *
     * @param $template_path
     * @return false|string
     * @throws \Exception
     */
    public function render($template_path)
    {
        if (!file_exists($template_path)) {
            throw new \Exception("$template_path template doesn't exist");
}
        $data = $this->data;

        ob_start();

        require $template_path;

        return ob_get_clean();
    }
}