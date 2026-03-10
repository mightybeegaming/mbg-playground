<?php
class Downloads {
    public function generateList() {
        $list = '';

        foreach(scandir('.downloads/') as $file):
            $file_full_path = '.downloads/' . $file;
            
            if(!is_file($file_full_path)) continue;

            $list .= '<tr>';
            $list .= '<td>' . htmlspecialchars($file) . '</td>';
            $list .= '<td class="file-size align-right">' . $this->formatSize(filesize($file_full_path)) . '</td>';
            $list .= '<td class="align-right"><span class="highlight"><a href="/.downloads/' . urlencode($file) . '" download>Download</a></span></td>';
            $list .= '</tr>';
        endforeach;

        return $list;
    }

    private function formatSize($bytes) {
        if($bytes >= 1073741824) return number_format($bytes / 1073741824, 2) . ' GB';
        if($bytes >= 1048576) return number_format($bytes / 1048576, 2) . ' MB';
        if($bytes >= 1024) return number_format($bytes / 1024, 2) . ' KB';
        return $bytes . ' B';
    }
}