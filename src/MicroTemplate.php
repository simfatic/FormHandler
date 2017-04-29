<?php
namespace FormGuide\Handlx;

/**
Modified From:
http://stackoverflow.com/questions/2066081/free-lightweight-template-system

 * Parses a php template, does variable substitution, and evaluates php code returning the result
 * sample usage:
 *       == template : /views/email/welcome.php ==
 *            Hello {name}, Good to see you.
 *            <?php if ('{name}' == 'Mike') { ?>
 *                <div>I know you're mike</div>
 *            <?php } ?>
 *       == code ==
 *            require_once("path/to/Microtemplate.php") ;
 *            $data["name"] = 'Mike' ;
 *            $string = Microtemplate::render('email/welcome', $data) ;
 */
class Microtemplate
{

    /**
     * Micro-template: Replaces {variable} with $data['variable'] and evaluates any php code.
     * @param string $view name of view under views/ dir. Must end in .php
     * @param array $data array of data to use for replacement with keys mapping to template variables {}.
     * @return string
     */


    public static function render($view, $data) 
    {
        $template = file_get_contents($view) ;
        // substitute {x} with actual text value from array
        $content = preg_replace("/\{([^\{]{1,100}?)\}/e", 'self::get_value("${1}", $data)' , $template);

        // evaluate php code in the template such as if statements, for loops, etc...
        ob_start() ;
        eval('?>' . "$content" . '<?php ;') ;
        $c = ob_get_contents() ;
        ob_end_clean() ;
        return $c ;
    }

    /**
     * Return $data[$key] if it's set. Otherwise, empty string.
     * @param string $key
     * @param array $data
     * @return string 
     */
    public static function get_value($key, $data)
    {
        if(!isset($data[$key]))
        {
            return '';
        }
        return htmlentities($data[$key]);
    }
}