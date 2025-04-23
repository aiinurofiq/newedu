<?php
defined('BASEPATH') or exit('No direct script access allowed');

use setasign\Fpdi\Fpdi;

class Rest_api extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('PDF_Rotate');
    }

    function generate()
    {
        $kopeg = $this->db->query('SELECT * FROM "tbl_event_peserta" WHERE "tahun" = 2025 AND "take_status" IS NULL ORDER BY "peserta_id" ASC FETCH FIRST 21 ROWS ONLY')->result_array();           
        for ($i = 0; $i < count($kopeg); $i++) {
            $fileName = $kopeg[$i]['qr_code'];
            $this->generate_qrcode($fileName);
            $this->db->where('peserta_id', $kopeg[$i]['peserta_id']);
            $this->db->update('tbl_event_peserta', ['take_status' => 1]);
        }
    }

    function generate_qrcode($data)
    {
        $qrcode = str_pad($data, 5, '0', STR_PAD_LEFT);
        $save_name  = $data . '.png';

        $dir = 'assets/media/qrcode/';
        if (!file_exists($dir)) {
            mkdir($dir, 0775, true);
        }

        /* QR Configuration  */
        $config['cacheable']    = true;
        $config['imagedir']     = $dir;
        $config['quality']      = true;
        // $config['size']         = '30';
        $config['black']        = array(255, 255, 255);
        $config['white']        = array(255, 255, 255);
        $config['margin']       = 0;
        $this->ciqrcode->initialize($config);

        /* QR Data  */
        $params['data']     = $data;
        $params['level']    = 'L';
        $params['savename'] = FCPATH . $config['imagedir'] . $save_name;

        $this->ciqrcode->generate($params);

        /* Return Data */
        $return = array(
            'content' => 'P-' . $qrcode,
            'file'    => $dir . $save_name
        );
        return $return;
    }

    public function generate_pdf()
    {
        $this->benchmark->mark('code_start');

        $totalpdf = $this->db->query('SELECT max(id) as last FROM tbl_pdf');
        $resulttotal = $totalpdf->row_array();

        $pdfTemplate = APPPATH . 'third_party/default-ticket.pdf';
        $fullName = $resulttotal['last'] + 1;
        $pdfTitle = $resulttotal['last'] + 1;

        $pdf = new PDF_Rotate();

        // Set custom paper size in millimeters
        $customWidthMM = 450.34; // Custom width in millimeters
        $customHeightMM = 310.3; // Custom height in millimeters

        // Add a page with the custom paper size
        $pdf->AddPage('L', array($customWidthMM, $customHeightMM));

        $pdf->setSourceFile($pdfTemplate);
        $tplIdx = $pdf->importPage(1);
        $pdf->useTemplate($tplIdx);

        // Add text
        $pdf->AddFont('AcerFoco-Regular', '', 'AcerFoco-Regular.php');

        // Set font and text color
        $pdf->SetFont('AcerFoco-Regular', '', 12); // Use the custom font here
        $pdf->SetTextColor(0, 0, 0);

        $query1 = $this->db->query('SELECT * FROM tbl_nmr WHERE flag = 0 limit 8');
        $result1 = $query1->result_array();

        $startPositionQRLeft = 9;
        $startPositionTextLeft = 10.3;
        foreach ($result1 as $key => $value) {
            if ($key == 0) {
                $startPositionQRLeft = 9;
                $startPositionTextLeft = 10.3;
            } else {
                $startPositionQRLeft += 23;
                $startPositionTextLeft += 23;
            }
            $pdf->Image(FCPATH  . 'assets/media/qrcode/P-' . str_pad($value['number_ticket'], 5, '0', STR_PAD_LEFT) . '.png', $startPositionQRLeft, 81);

            $pdf->SetXY($startPositionTextLeft, 99.5);
            $pdf->Cell(0, 0, str_pad($value['number_ticket'], 5, '0', STR_PAD_LEFT), 0, 1, 'L');

            $this->db->where('id', $value['id']);
            $this->db->update('tbl_nmr', ['flag' => 1]);
        }

        $query2 = $this->db->query('SELECT * FROM tbl_nmr WHERE flag = 0 LIMIT 13');
        $result2 = $query2->result_array();

        $startPositioQRRight = 8.9;
        $startPositionTextLeft = 11;
        foreach ($result2 as $key => $value) {
            if ($key == 0) {
                $startPositioQRRight = 8.9;
                $startPositionTextLeft = 11;
            } else {
                $startPositioQRRight += 23;
                $startPositionTextLeft += 23;
            }
            $pdf->Image(FCPATH  . 'assets/media/qrcode/P-' . str_pad($value['number_ticket'], 5, '0', STR_PAD_LEFT) . '.png', 375, $startPositioQRRight);
            $pdf->RotatedText(371.5, $startPositionTextLeft, str_pad($value['number_ticket'], 5, '0', STR_PAD_LEFT), 270, 'L');

            $this->db->where('id', $value['id']);
            $this->db->update('tbl_nmr', ['flag' => 1]);
        }

        $pdf->SetTitle($pdfTitle);

        $fileName = preg_replace('/[\s\W]+/', '_', $fullName);
        $tmp_folder = FCPATH  . 'assets/media/ticket/' . $fileName . '.pdf';
        $pdf->Output($tmp_folder, 'F');

        $this->db->insert('tbl_pdf', ['last_pdf' => $resulttotal['last'] + 1]);

        $this->benchmark->mark('code_end');
        echo $this->benchmark->elapsed_time('code_start', 'code_end');

        echo '<br>' . $pdfTitle;
    }

    public function generates_pdf()
    {
        $this->benchmark->mark('code_start');

        $pdfTemplate = APPPATH . 'third_party/default-ticket-35.pdf';
        $fullName = 1;
        $pdfTitle = 1;

        $pdf = new PDF_Rotate();

        // Set custom paper size in millimeters
        $customWidthMM = 483; // Custom width in millimeters
        $customHeightMM = 330; // Custom height in millimeters

        // Add a page with the custom paper size
        $pdf->AddPage('L', array($customWidthMM, $customHeightMM));

        $pdf->setSourceFile($pdfTemplate);
        $tplIdx = $pdf->importPage(1);
        $pdf->useTemplate($tplIdx);

        // Add text
        $pdf->AddFont('AcerFoco-Regular', '', 'AcerFoco-Regular.php');

        // Set font and text color
        $pdf->SetFont('AcerFoco-Regular', '', 12.5); // Use the custom font here
        $pdf->SetTextColor(0, 0, 0);


        $kopeg = $this->db->query('SELECT * FROM "tbl_event_peserta" WHERE "tahun" = 2025 AND "take_status" IS NOT NULL ORDER BY "peserta_id" ASC FETCH FIRST 21 ROWS ONLY')->result_array();

        $startPositionQRLeft = 25.3;
        $startPositionTextTop = 91;

        for ($i = 0; $i < 8; $i++) { 
            $peserta = $kopeg[$i];
            $peserta_id = $peserta['qr_code'];

            if ($i > 0) {
                $startPositionQRLeft += 23;
            }

            $pdf->Image(FCPATH . 'assets/media/qrcode/' . $peserta_id . '.png', $startPositionQRLeft, 93.1);
            $pdf->RotatedText($startPositionQRLeft + 13, $startPositionTextTop, $peserta_id, 90, 'C');
        }

        $startPositioQRRight = 18.9;
        $startPositionTextRight = 32;

        for ($i = 8; $i < 21; $i++) { 
            $peserta = $kopeg[$i]; // Ambil data dari hasil query
            $peserta_id = $peserta['qr_code'];

            if ($i > 8) {
                $startPositioQRRight += 23;
                $startPositionTextRight += 23;
            }

            $pdf->Image(FCPATH . 'assets/media/qrcode/' . $peserta_id . '.png', 389.1, $startPositioQRRight);
            $pdf->RotatedText(406.6, $startPositionTextRight, $peserta_id, 0, 'L');
        }
        $pdf->SetTitle($pdfTitle);

        $fileName = preg_replace('/[\s\W]+/', '_', $fullName);
        $tmp_folder = FCPATH  . 'assets/media/tickets/' . $fileName . '.pdf';
        $pdf->Output($tmp_folder, 'F');

        $this->benchmark->mark('code_end');
        echo $this->benchmark->elapsed_time('code_start', 'code_end');
    }

    public function generate_landyard($start = '', $end = '')
    {
        $this->benchmark->mark('code_start');

        $totalpdf = $this->db->query('SELECT max(id) as last FROM tbl_pdf');
        $resulttotal = $totalpdf->row_array();

        $pdfTemplate = APPPATH . 'third_party/default-landyard.pdf';
        $fullName = $resulttotal['last'] + 1;
        $pdfTitle = $resulttotal['last'] + 1;

        $pdf = new PDF_Rotate();

        // Set custom paper size in millimeters
        $customWidthMM = 420.03; // Custom width in millimeters
        $customHeightMM = 297.01; // Custom height in millimeters

        // Add a page with the custom paper size
        $pdf->AddPage('L', array($customWidthMM, $customHeightMM));

        $pdf->setSourceFile($pdfTemplate);
        $tplIdx = $pdf->importPage(1);
        $pdf->useTemplate($tplIdx);

        // Add text
        $pdf->AddFont('Quicksand-SemiBold', '', 'Quicksand-SemiBold.php');

        // Set font and text color
        $pdf->SetFont('Quicksand-SemiBold', '', 35); // Use the custom font here
        $pdf->SetTextColor(0, 0, 0);

        $query1 = $this->db->query('SELECT * FROM tbl_nmr WHERE flag = 0 limit 4');
        $result1 = $query1->result_array();

        $startPositionQRTop = 31.5;
        $startPositionTextTop = 38;
        foreach ($result1 as $key => $value) {
            if ($key == 0) {
                $startPositionQRTop = 31.5;
                $startPositionTextTop = 38;
            } else {
                $startPositionQRTop += 95;
                $startPositionTextTop += 95;
            }
            $pdf->Image(FCPATH  . 'assets/media/qr_code/VIP-' . str_pad($value['number_ticket'], 5, '0', STR_PAD_LEFT) . '.png', $startPositionQRTop, 65);

            $pdf->SetXY($startPositionTextTop, 118);
            $pdf->Cell(0, 0, str_pad($value['number_ticket'], 5, '0', STR_PAD_LEFT), 0, 1, 'L');

            $this->db->where('id', $value['id']);
            $this->db->update('tbl_nmr', ['flag' => 1]);
        }

        $query2 = $this->db->query('SELECT * FROM tbl_nmr WHERE flag = 0 limit 4');
        $result2 = $query2->result_array();

        $startPositionQRBottom = 31.5;
        $startPositionTextBottom = 38;
        foreach ($result2 as $key2 => $value2) {
            if ($key2 == 0) {
                $startPositionQRBottom = 31.5;
                $startPositionTextBottom = 38;
            } else {
                $startPositionQRBottom += 95;
                $startPositionTextBottom += 95;
            }

            $pdf->Image(FCPATH  . 'assets/media/qr_code/VIP-' . str_pad($value2['number_ticket'], 5, '0', STR_PAD_LEFT) . '.png', $startPositionQRBottom, 190);

            $pdf->SetXY($startPositionTextBottom, 243);
            $pdf->Cell(0, 0, str_pad($value2['number_ticket'], 5, '0', STR_PAD_LEFT), 0, 1, 'L');

            $this->db->where('id', $value2['id']);
            $this->db->update('tbl_nmr', ['flag' => 1]);
        }

        $fileName = preg_replace('/[\s\W]+/', '_', $fullName);
        $tmp_folder = FCPATH  . 'assets/media/landyard/' . $fileName . '.pdf';
        $pdf->Output($tmp_folder, 'F');

        $this->db->insert('tbl_pdf', ['last_pdf' => $resulttotal['last'] + 1]);

        $this->benchmark->mark('code_end');
        echo $this->benchmark->elapsed_time('code_start', 'code_end');

        echo '<br>' . $pdfTitle;
    }

    public function generate_qr()
    {
        for ($i = 1551; $i <= 1555; $i++) {
            $fileName = 'G-' . str_pad($i, 5, '0', STR_PAD_LEFT);
            // Raw data
            $data = array(
                "data" => $fileName,
                "config" => array(
                    "body" => "circle",
                    "eye" => "frame13",
                    "eyeBall" => "ball15",
                    "erf1" => [],
                    "erf2" => [],
                    "erf3" => [],
                    "brf1" => [],
                    "brf2" => [],
                    "brf3" => [],
                    "bodyColor" => "#000000",
                    "bgColor" => "#ffffff",
                    "eye1Color" => "#000000",
                    "eye2Color" => "#000000",
                    "eye3Color" => "#000000",
                    "eyeBall1Color" => "#000000",
                    "eyeBall2Color" => "#000000",
                    "eyeBall3Color" => "#000000",
                    "gradientColor1" => "",
                    "gradientColor2" => "",
                    "gradientType" => "linear",
                    "gradientOnEyes" => "true",
                    "logo" => "",
                    "logoMode" => "default"
                ),
                "size" => 130,
                "download" => "imageUrl",
                "file" => "png"
            );

            // Convert data to JSON format
            $postData = json_encode($data);

            // API endpoint
            $url = "https://api.qrcode-monkey.com/qr/custom";

            // Initialize cURL session
            $curl = curl_init();

            // Set cURL options
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $postData,
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($postData)
                )
            ));

            // Execute cURL request
            $response = curl_exec($curl);

            // Check for errors
            if (curl_error($curl)) {
                echo 'Error: ' . curl_error($curl);
            } else {
                // Decode JSON response
                $responseData = json_decode($response, true);

                // Check if download URL is present in response
                if (isset($responseData['imageUrl'])) {
                    // Download the image
                    $imageData = file_get_contents(str_replace("//", "https://", $responseData['imageUrl']));


                    // Save the image locally
                    file_put_contents(FCPATH  . 'assets/media/qr_code/' . 'VIP-' . str_pad($i, 5, '0', STR_PAD_LEFT) . '.png', $imageData);
                    echo 'Image downloaded successfully! - ' . $fileName . '<br>';
                } else {
                    echo 'Failed to get download URL - ' . $fileName . '<br>';
                }
            }

            // Close cURL session
            curl_close($curl);
        }
    }

    public function generate_qr_code()
    {
        $kopeg = $this->db->query('SELECT * FROM "tbl_event_peserta" WHERE "tahun" = 2025 AND "take_status" IS NULL ORDER BY "peserta_id" ASC FETCH FIRST 10 ROWS ONLY')->result_array();
        for ($i = 0; $i < count($kopeg); $i++) {
            // $fileName = 'G-' . str_pad($i, 5, '0', STR_PAD_LEFT);
            $fileName = $kopeg[$i]['qr_code'];
            // Raw data
            $data = array(
                "data" => $fileName,
                "config" => array(
                    "body" => "circle",
                    "eye" => "frame13",
                    "eyeBall" => "ball15",
                    "erf1" => [],
                    "erf2" => [],
                    "erf3" => [],
                    "brf1" => [],
                    "brf2" => [],
                    "brf3" => [],
                    "bodyColor" => "#000000",
                    "bgColor" => "#ffffff",
                    "eye1Color" => "#000000",
                    "eye2Color" => "#000000",
                    "eye3Color" => "#000000",
                    "eyeBall1Color" => "#000000",
                    "eyeBall2Color" => "#000000",
                    "eyeBall3Color" => "#000000",
                    "gradientColor1" => "",
                    "gradientColor2" => "",
                    "gradientType" => "linear",
                    "gradientOnEyes" => "true",
                    "logo" => "",
                    "logoMode" => "default"
                ),
                "size" => 80,
                "download" => "imageUrl",
                "file" => "png"
            );

            // Convert data to JSON format
            $postData = json_encode($data);

            // API endpoint
            $url = "https://api.qrcode-monkey.com/qr/custom";

            // Initialize cURL session
            $curl = curl_init();

            // Set cURL options
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $postData,
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($postData)
                )
            ));

            // Execute cURL request
            $response = curl_exec($curl);

            // Check for errors
            if (curl_error($curl)) {
                echo 'Error: ' . curl_error($curl);
            } else {
                // Decode JSON response
                $responseData = json_decode($response, true);

                // Check if download URL is present in response
                if (isset($responseData['imageUrl'])) {
                    // Download the image
                    $imageData = file_get_contents(str_replace("//", "https://", $responseData['imageUrl']));


                    // Save the image locally
                    file_put_contents(FCPATH  . 'assets/media/qr_code/' . $fileName . '.png', $imageData);
                    echo 'Image downloaded successfully! - ' . $fileName . '<br>';
                    $this->db->where('peserta_id', $kopeg[$i]['peserta_id']);
                    $this->db->update('tbl_event_peserta', ['take_status' => 1]);
                } else {
                    echo 'Failed to get download URL - ' . $fileName . '<br>';
                }
            }

            // Close cURL session
            curl_close($curl);
        }
    }
}
