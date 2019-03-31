<?php

namespace App\Classes;

use PhpOffice\PhpWord\TemplateProcessor;

class DeleteRow extends TemplateProcessor 
{

    public function deleteRow($search)
    {
        if ('${' !== substr($search, 0, 2) && '}' !== substr($search, -1)) {
        $search = '${' . $search . '}';
        }

        $tagPos = strpos($this->tempDocumentMainPart, $search);

        if (!$tagPos) {
            throw new Exception("Can not remove row, template variable not found or variable contains markup. ". $search);
        }

        $rowStart = $this->findRowStart($tagPos);
        $rowEnd = $this->findRowEnd($tagPos);
        $xmlRow = $this->getSlice($rowStart, $rowEnd);

        $this->tempDocumentMainPart = str_replace($xmlRow, "", $this->tempDocumentMainPart);

        return true;

    }
}