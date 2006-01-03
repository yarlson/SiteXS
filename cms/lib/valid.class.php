<?
class Validator {

    var $formName;
    var $testCases = array ();
    var $usedFunct = array ();
    var $alertOnMissingFormVar;

    function Validator ( $f ) {
        $this->formName = $f;
        $this->alertOnMissingFormVar = FALSE;
    }

    function setMissingAlert ( $state ) { $this->alertOnMissingFormVar = $state; }

    function addExists ( $fv, $desc ) { $this->add ( $fv, $desc,  "EXISTS" ); }

    function addEmail  ( $fv ) { $this->add ( $fv, "", "EMAIL"  ); }

    function addEqual  ( $fv1, $fv2, $desc ) { $this->add ( $fv1, $desc, "EQUAL", $fv2 ); }

    function addCopy   ( $fv1, $fv2 ) { $this->add ( $fv1, "", "COPY", $fv2 ); }

    function add ( $fv, $desc, $t, $xtra=NULL ) {
        $this->testCases[] = array ( "NAME" => $fv,
                                     "DESC" => $desc,
                                     "TEST" => $t,
                                     "XTRA" => $xtra );
        $this->usedFunct[$t] = "YES";
    }

    function toHtml () {
        $msg = "";


        $msg .= ( "function isEmpty(s) { return ((s == null) || (s.length == 0)); }\n" );
        $msg .= ( "var whitespace = \" \\t\\n\\r\";\n" . 
                  "function isWhitespace (s) {\n" .
                  "  var i;\n" .
                  "  if (isEmpty(s)) return true;\n" .
                  "  for (i = 0; i < s.length; i++) {\n" .
                  "    var c = s.charAt(i);\n" .
                  "    if (whitespace.indexOf(c) == -1) return false;\n" .
                  "  }\n" .
                  "  return true;\n" .
                  "}\n" );
        
        foreach ( $this->usedFunct as $key => $val ) {
            switch ( $key ) {
            case "EXISTS":
                $msg .= ( "function doesExist (s) { return ( ! isEmpty(s) && ! isWhitespace (s) ); }\n" );
                break;
                
            case "EMAIL":
                $msg .= "var iEmail = \"This field must be a valid email address (like foo@bar.com). Please reenter it now.\";\n";
                $msg .= ( "function isEmail (s) {\n" . 
                          "  if (isEmpty(s)) return ( true );\n" .
                          "  if (isWhitespace(s)) return ( false );\n" .
                          "  var i = 1;\n" .
                          "  var sLength = s.length;\n" .
                          "  while ((i < sLength) && (s.charAt(i) != \"@\")) { i++; }\n" .
                          "  if ((i >= sLength) || (s.charAt(i) != \"@\")) return ( false );\n" .
                          "  else i += 2;\n" .
                          "  while ((i < sLength) && (s.charAt(i) != \".\")) { i++; }\n" .
                          "  if ((i >= sLength - 1) || (s.charAt(i) != \".\")) return ( false );\n" .
                          "  else return ( true );\n" .
                          "}\n" );
                break;
            }
        }

        $msg .= "function validateForm() {\n";
        $msg .= "  var form = document.$this->formName;\n";
        foreach ( $this->testCases as $val ) {
            $nam  = $val["NAME"];
            $desc = $val["DESC"];

            $msg .= "  if ( form.elements[\"$nam\"] ) {\n";

            switch ( $val["TEST"] ) {
            case "EXISTS":
                $msg .= "    if ( ! doesExist ( form.elements[\"$nam\"].value ) ) {\n";
                $msg .= "      alert ( \"Поле \\\"\"+form.elements[\"$nam\"].title+\"\\\" должно быть заполненным!\" );\n";
                $msg .= "      form.elements[\"$nam\"].focus();\n";
                $msg .= "      return ( false );\n";
                $msg .= "    }\n";
                break;
                
            case "EMAIL":
                $msg .= "    if ( ! isEmail ( form.elements[\"$nam\"].value ) ) {\n";
                $msg .= "      alert ( iEmail );\n";
                $msg .= "      form.elements[\"$nam\"].focus();\n";
                $msg .= "      return ( false );\n";
                $msg .= "    }\n";
                break;
                
            case "EQUAL":
                $nam2 = $val["XTRA"];
                $msg .= "    if ( form.elements[\"$nam\"].value != form.elements[\"$nam2\"].value ) {\n";
                $msg .= "      alert ( \"Поле \\\"\"+form.elements[\"$nam\"].title+\"\\\" должно быть равно полю \\\"\"+form.elements[\"$nam2\"].title+\"\\\"!\" );\n";
                $msg .= "      form.elements[\"$nam\"].focus();\n";
                $msg .= "      return ( false );\n";
                $msg .= "    }\n";
                break;
                
            case "COPY":
                $nam2 = $val["XTRA"];
                $msg .= "    if ( ! doesExist ( form.elements[\"$nam2\"].value ) ) {\n";
                $msg .= "      form.elements[\"$nam2\"].value = form.elements[\"$nam\"].value\n";
                $msg .= "    }\n";
                break;
            }

            $msg .= "  }\n";
            
            if ( $this->alertOnMissingFormVar ) {
                $msg .= "  else {\n";
                $msg .= "    alert ( \"Form variable '$nam' does not exist in this form\" );\n";
                $msg .= "    return ( false );\n";
                $msg .= "  }\n";
            }
        }
        
        $msg .= "  return ( true );\n";
        $msg .= "}\n";
        $msg .= "function validateAndSubmit() {\n";
        $msg .= "  var form = document.$this->formName;\n";
        $msg .= "  var ok = validateForm ();\n";
        $msg .= "  if ( ok ) form.submit ();\n";
        $msg .= "  return ( ok );\n";
        $msg .= "}\n";
        return ( "<script type=\"text/javascript\" language=\"JavaScript\">\n" .
                 $msg .
                 "</script>\n" );
    }

    function onSubmit ( $s="" ) {
        return ( "onSubmit=\"{$s}return validateForm();\"" );
    }

    function doSubmit ( $s="" ) {
        return ( "onClick=\"{$s}return validateAndSubmit();\"" );
    }
}


?>