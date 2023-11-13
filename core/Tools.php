<?php
namespace Core;

class Tools
{



    public function sanitize($input)
    {
        // Eliminar espacios en blanco al inicio y al final
        $input = trim($input);
        // Eliminar etiquetas HTML y caracteres especiales
        $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
        $input = str_replace("<script>", "", $input);
        $input = str_replace("<script>", "", $input);
        $input = str_replace("</script>", "", $input);
        $input = str_replace("<script type=>", "", $input);
        $input = str_replace("SELECT * FROM", "", $input);
        $input = str_replace("select * from", "", $input);
        $input = str_replace("DELETE FROM", "", $input);
        $input = str_replace("delete from", "", $input);
        $input = str_replace("INSERT INTO", "", $input);
        $input = str_replace("insert into", "", $input);
        $input = str_replace("DROP DATABASE", "", $input);
        $input = str_replace("drop database", "", $input);
        $input = str_replace("--", "", $input);
        $input = str_replace("^", "", $input);
        $input = str_replace("[", "", $input);
        $input = str_replace("]", "", $input);
        $input = str_replace("==", "", $input);
        $input = str_replace("=", "", $input);
        $input = str_replace("/", "", $input);
        $input = str_replace(">", "", $input);
        $input = str_replace("<", "", $input);
        $input = str_replace("'", "", $input);
        $input = str_replace(";", "", $input);
        $input = str_replace("%", "", $input);
        $input = str_replace("(", "", $input);
        $input = str_replace(")", "", $input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        $input = addslashes($input);

        // Retornar el valor limpio
        return $input;
    }

    public function validateFields($fields)
    {
        $errors = [];

        foreach ($fields as $fieldName => $field) {
            if (empty($field)) {
                $errors[$fieldName] = "Campo {$fieldName} es obligatorio.";
            }
        }

        return $errors;
    }


}
?>