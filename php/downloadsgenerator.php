<?php
/*
 * Downloads Generator
 */
class DownloadsGenerator {
    public function getDownloadList() {
        $downloadList = '';

        foreach(scandir('.downloads') as $file):
            $file_full_path = '.downloads/' . $file;
            
            if(!is_file($file_full_path)) continue;

            $downloadList .= '<tr>';
            $downloadList .= '<td>' . htmlspecialchars($file) . '</td>';
            $downloadList .= '<td class="file-size align-right">' . $this->formatSize(filesize($file_full_path)) . '</td>';
            $downloadList .= '<td class="align-right"><span class="highlight"><a href="/.downloads/' . urlencode($file) . '" download>Download</a></span></td>';
            $downloadList .= '</tr>';
        endforeach;

        return $downloadList;
    }

    private function formatSize($bytes) {
        if($bytes >= 1073741824) return number_format($bytes / 1073741824, 2) . ' GB';
        if($bytes >= 1048576) return number_format($bytes / 1048576, 2) . ' MB';
        if($bytes >= 1024) return number_format($bytes / 1024, 2) . ' KB';
        return $bytes . ' B';
    }
}