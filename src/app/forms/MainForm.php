<?php
namespace app\forms;

use std, gui, framework, app;


class MainForm extends AbstractForm
{
$files = array();
$dir = "";
    /**
     * @event button.action 
     */
    function doButtonAction(UXEvent $e = null)
    {
        global $files, $dir;    
        $this->listView->itemsText="";
        $dir = $this->edit->text;
        $files = array();
        if (fs::exists($dir)) {
        $files = scandir($dir);
        unset($files[0]);
        unset($files[1]);
        $files=array_values($files);
         for ($i=0; $i<=count($files); $i++) {
             if ($files[$i] != null) {
              $this->listView->items[$i]=$files[$i];
              }
         }
         $this->label->visible=true;
         $this->label->text="Finded " . count($files) . " files";
         $this->button3->enabled=true;
       } 
       else {
        $this->label->visible=true;
       $this->label->text="Folder don't exist";
       }
    }

    /**
     * @event buttonAlt.action 
     */
    function doButtonAltAction(UXEvent $e = null)
    {    
        global $files, $dir;     
        $sel = $this->listView->selectedIndex;
        $this->listView->itemsText="";
        unset($files[$sel]);
        $files = array_values($files);
        for ($i=0; $i<=count($files); $i++) {
             if ($files[$i] != null) {
              $this->listView->items[$i]=$files[$i];
              }
         }
    }

    /**
     * @event button4.action 
     */
    function doButton4Action(UXEvent $e = null)
    {
        $e = $event ?: $e; 
        app()->shutdown();
    }

    /**
     * @event button3.action 
     */
    function doButton3Action(UXEvent $e = null)
    {    
     global $files, $dir;     
   
    
    for ($i=0; $i<=count($files); $i++) {
    if ($files[$i] != null || $files[$i] != "") {
         $file = $dir . "/" . $files[$i];
         $this->textAreaAlt->text=Stream::getContents($file) . "\n";
         $this->textAreaAlt->text=$this->textAreaAlt->text . $this->textArea->text;
         $text = $this->textAreaAlt->text;
         Stream::putContents($file, $text);
         $this->textArea3->text = $this->textArea3->text . $files[$i] . " --- Done \n";
         }
    }
   $this->textArea3->text = $this->textArea3->text . "-------------------------\r\n Ready";
   $this->buttin3->enable=false;
    }

    /**
     * @event button5.action 
     */
    function doButton5Action(UXEvent $e = null)
    {    
        $this->listView->itemsText="";
        $this->label->text="";
        $this->button3->enabled=false;
    }

}
