<?php
CModule::IncludeModule('iblock');
define('IBLOCK_PRODUCTS', 4);
$rsSection =CIBlockSection::GetList(
    array(),
    array(

        'IBLOCK_ID' => IBLOCK_PRODUCTS,

    ),

    [
        'ID', 'IBLOCK_ID', 'NAME', 'IBLOCK_SECTION_ID', 'SUBSECTION'
    ],
    false

);
$i=0-3;
while($arSection = $rsSection->GetNext()) {
    echo '<pre>';
    //print_r($arSection);
    echo '</pre>';
    $arRazdel[$i] = $arSection;
    $i++;
}


for($i=-3; $i<0; $i++)
{
    if(empty($arRazdel[$i]['IBLOCK_SECTION_ID']))
    {
        $arRes=array(
            'NAME'=>$arRazdel[$i]['NAME'],
            'IBLOCK_SECTION_ID'=>$arRazdel[$i]['IBLOCK_SECTION_ID'],
            'ID'=>$arRazdel[$i]['ID'],
            'SUBSECTION'=> array()
        );
       // print_r($arRes['NAME']);
        $k=0;
        for($j=0; $j<9;$j++){
            //print_r($arRazdel[$j]['NAME']);
            if($arRazdel[$j]['IBLOCK_SECTION_ID'] == $arRazdel[$i]['ID'])
            {

                /*$id = array(
                     $i=>array(
                        $k=> array(
                            'NAME'=>$arRazdel[$j]['NAME'],
                            'IBLOCK_SECTION_ID'=>$arRazdel[$j]['IBLOCK_SECTION_ID'],
                            'ID'=>$arRazdel[$j]['ID'],
                        )
                    )

                );*/


                array_push($arRes['SUBSECTION'], array(
                        $k=> array(
                            'NAME'=>$arRazdel[$j]['NAME'],
                            'IBLOCK_SECTION_ID'=>$arRazdel[$j]['IBLOCK_SECTION_ID'],
                            'ID'=>$arRazdel[$j]['ID'],
                        )
                    )

                );
                $arResult[] = $arRes;
                $k++;
                echo '<pre>';
                //print_r($id);
                echo '</pre>';



            }

        }
        echo '<pre>';
        //print_r($id[-3][3]['NAME']);
        echo '</pre>';
/*
        for($f=0; $f<$k; $f++){
            echo '<pre>';
            print_r($id[$i][$f]['NAME']);
            echo '</pre>';

           $arRes['SUBSECTION']=array(
                $f=> array(
                    'NAME'=>$id[$i][$f]['NAME'],
                    'IBLOCK_SECTION_ID'=>$id[$i][$f]['IBLOCK_SECTION_ID'],
                    'ID'=>$id[$i][$f]['ID'],
                )
            );



        }
*/

        echo '<pre>';
       //print_r($arRes);
        echo '</pre>';



    }


}
echo '<pre>';
print_r($arResult);
echo '</pre>';



$this->IncludeComponentTemplate();
