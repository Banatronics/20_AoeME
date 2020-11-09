<?php


    define("C_Black",0);
    define("C_Maroon",1);
    define("C_Green",2);
    define("C_Olive",3);
    define("C_Navy",4);
    define("C_Purple",5);
    define("C_Teal",6);
    define("C_Gray",7);
    define("C_Silver",8);
    define("C_Red",9);
    define("C_Lime",10);
    define("C_Yellow",11);
    define("C_Blue",12);
    define("C_Fuchsia",13);
    define("C_Aqua",14);
    define("C_White",15);

    $outFile = 'c:\wamp64\www\GitHub\20_AoeME\Data\EUR-AFRICA_16_converted.bmp';
    FormatImg('c:\wamp64\www\GitHub\20_AoeME\Data\EUR-AFRICA_16.bmp');
    

    function FormatImg($filename)
    {
        GLOBAL  $outFile;
        /* add code here to change undesired pixel colors to needed ones*/
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $image = imagecreatefrombmp($filename);

        $RGB_Black = imagecolorallocate($image, 0, 0, 0);
        $RGB_Maroon = imagecolorallocate($image, 128, 0, 0);
        $RGB_Green = imagecolorallocate($image, 0, 128, 0);
        $RGB_Olive = imagecolorallocate($image, 128, 128, 0);
        $RGB_Navy = imagecolorallocate($image, 0, 0, 128);
        $RGB_Purple = imagecolorallocate($image, 128, 0, 128);
        $RGB_Teal = imagecolorallocate($image, 0, 128, 128);
        $RGB_Gray = imagecolorallocate($image, 128, 128, 128);
        $RGB_Silver = imagecolorallocate($image, 192, 192, 192);
        $RGB_Red = imagecolorallocate($image, 255, 0, 0);
        $RGB_Lime = imagecolorallocate($image, 0, 255, 0);
        $RGB_Yellow = imagecolorallocate($image, 255, 255, 0);
        $RGB_Blue = imagecolorallocate($image, 0, 0, 255);
        $RGB_Fuchsia = imagecolorallocate($image, 255, 0, 255);
        $RGB_Aqua = imagecolorallocate($image, 0, 255, 255);
        $RGB_White = imagecolorallocate($image, 255, 255, 255);

        $ColorIDMapping = array(
            C_Black => $RGB_Green, /* Black to forest */
            C_Gray => $RGB_Lime, /* Gray to grass */
            C_Teal => $RGB_Lime, /* Teal to grass */
            C_Olive => $RGB_Lime, /* Olive to grass */
            C_Silver => $RGB_Lime, /* Silver to grass */
            C_Navy => $RGB_Green, /* Navy to forest */
            C_Maroon => $RGB_Green, /* Maroon to forest */
            C_White => $RGB_Green /* White to forest */
        );

        $Ysize=240;
        $Xsize=240;
        echo("So far so good");
        for($Y=0; $Y<$Ysize; $Y++)
        {
            /* TDO */
            for($X=0; $X<$Xsize; $X++)
            {
                /* TDO */
                $id = @imageColorAt($image,$X,$Y);
                if(isset($ColorIDMapping[$id]))
                {
                    /* manipulate pixel */
                    $colorRGB = imagecolorsforindex($image, $id);
                    echo('Y='. $Y . ' X=' . $X . ' ID='. $id . ' color = '. $ColorIDMapping[$id]);
                    print_r($colorRGB);
                    imagesetpixel($image, $X, $Y, $ColorIDMapping[$id]);
                    $id = @imageColorAt($image,$X,$Y);
                    $colorRGB = imagecolorsforindex($image, $id);
                    echo('  AFTER: Y='. $Y . ' X=' . $X . ' ID='. $id);
                    print_r($colorRGB);
                    
                    echo ("</br>");
                }
                
            }
        }
        
        imagebmp($image, $outFile);

    }
?>