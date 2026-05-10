<?php
function getStatusText($status)
{
    $map = [
        'new' => 'Baru',
        'processed' => 'Diproses',
        'done' => 'Selesai'
    ];
    return $map[$status] ?? $status;
}

$complaints = $data['complaints'] ?? [];
$startDateRaw = $data['metadata']['start_date'] ?? null;
$endDateRaw = $data['metadata']['end_date'] ?? null;

if ($startDateRaw && $endDateRaw) {
    $dateRange = formatDate($startDateRaw, false) . ' s/d ' . formatDate($endDateRaw, false);
} elseif ($startDateRaw) {
    $dateRange = formatDate($startDateRaw, false) . ' s/d sekarang';
} elseif ($endDateRaw) {
    $dateRange = 'Awal s/d ' . formatDate($endDateRaw, false);
} else {
    $dateRange = 'Semua Data';
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Laporan Pengaduan + Tanggapan Masyarakat</title>
    <meta charset="UTF-8">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Times New Roman', 'Georgia', 'Cambria', serif;
            background: white;
            padding: 0;
            margin: 0;
        }

        .report-page {
            max-width: 100%;
            padding: 0;
        }

        .laporan-header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 8px;
            border-bottom: 2px solid #000;
        }

        .laporan-header h1 {
            font-size: 18px;
            font-weight: bold;
            letter-spacing: 1px;
            margin-bottom: 4px;
        }

        .info-laporan {
            margin-bottom: 20px;
            font-size: 11px;
            line-height: 1.5;
        }

        .info-laporan table {
            width: 100%;
        }

        .info-laporan td {
            padding: 2px 0;
        }

        .group-pengaduan {
            margin-bottom: 24px;
            border: 1px solid #000;
            page-break-inside: avoid;
            break-inside: avoid;
        }

        .group-pengaduan:last-child {
            margin-bottom: 0;
        }

        .table-pengaduan {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }

        .table-pengaduan th,
        .table-pengaduan td {
            border: 1px solid #000;
            padding: 8px 6px;
            text-align: left;
            vertical-align: top;
        }

        .table-pengaduan th {
            background: none;
            font-weight: 600;
        }

        .wrapper-tanggapan {
            padding: 8px 10px;
            background: #fefefe;
        }

        .label-tanggapan {
            font-size: 10px;
            font-weight: 600;
            margin-bottom: 6px;
            display: inline-block;
            border-bottom: 1px solid #000;
        }

        .table-tanggapan {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
        }

        .table-tanggapan th,
        .table-tanggapan td {
            border: 1px solid #000;
            padding: 5px 6px;
            text-align: left;
            vertical-align: top;
        }

        .table-tanggapan th {
            background: none;
            font-weight: 600;
        }

        .status {
            display: inline-block;
            font-size: 11px;
            font-weight: normal;
        }

        .no-tanggapan {
            font-size: 10px;
            font-style: italic;
            padding: 8px;
        }

        .laporan-footer {
            margin-top: 25px;
            padding-top: 10px;
            border-top: 1px solid #000;
            font-size: 10px;
            text-align: center;
        }

        @page {
            size: A4;
            margin: 2.5cm;
        }

        @media print {
            body {
                padding: 0;
                margin: 0;
            }

            .group-pengaduan {
                page-break-inside: avoid;
                break-inside: avoid;
            }
        }
    </style>
</head>

<body>
    <div class="report-page">
        <div class="laporan-header">
            <h1>LAPORAN PENGADUAN MASYARAKAT</h1>
        </div>

        <div class="info-laporan">
            <table>
                <tr>
                    <td style="width: 120px;">Periode</td>
                    <td>: <?= !empty($dateRange) ? htmlspecialchars($dateRange) : 'Semua Data' ?></td>
                </tr>
                <tr>
                    <td>Tanggal Cetak</td>
                    <td>: <?= formatDate(date('Y-m-d H:i:s'), false) ?></td>
                </tr>
                <tr>
                    <td>Jumlah Pengaduan</td>
                    <td>: <?= count($complaints) ?> laporan</td>
                </tr>
            </table>
        </div>

        <?php if (count($complaints) > 0):  ?>
            <?php foreach ($complaints as $index => $complaint): ?>
                <div class="group-pengaduan">
                    <table class="table-pengaduan">
                        <thead>
                            <tr>
                                <th style="width: 35px;">No</th>
                                <th style="width: 90px;">Kode</th>
                                <th>Judul / Isi Pengaduan</th>
                                <th style="width: 140px;">Lokasi</th>
                                <th style="width: 100px;">Pelapor</th>
                                <th style="width: 80px;">Tanggal</th>
                                <th style="width: 70px;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="text-align: center;"><?= $index + 1 ?></td>
                                <td><?= htmlspecialchars($complaint['complaint_code']) ?></td>
                                <td>
                                    <strong><?= htmlspecialchars($complaint['title']) ?></strong><br>
                                    <span style="font-size: 10px;"><?= htmlspecialchars($complaint['content']) ?></span>
                                </td>
                                <td><?= htmlspecialchars($complaint['location']) ?></td>
                                <td>
                                    <?= htmlspecialchars($complaint['reporter_name']) ?><br>
                                    <span style="font-size: 9px;"><?= htmlspecialchars($complaint['reporter_phone']) ?></span>
                                </td>
                                <td><?= formatDate($complaint['created_at'], false) ?></td>
                                <td><span class="status"><?= getStatusText($complaint['status']) ?></span></td>
                            </tr>
                        </tbody>
                    </table>

                    <?php if (!empty($complaint['responses'])): ?>
                        <div class="wrapper-tanggapan">
                            <div class="label-tanggapan">TANGGAPAN (<?= count($complaint['responses']) ?>)</div>
                            <table class="table-tanggapan">
                                <thead>
                                    <tr>
                                        <th style="width: 30px;">No</th>
                                        <th style="width: 90px;">Tanggal</th>
                                        <th style="width: 130px;">Pemberi Tanggapan</th>
                                        <th>Isi Tanggapan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($complaint['responses'] as $ridx => $response): ?>
                                        <tr>
                                            <td style="text-align: center;"><?= $ridx + 1 ?></td>
                                            <td><?= formatDate($response['created_at'], false) ?></td>
                                            <td><?= htmlspecialchars($response['responder_name']) ?></td>
                                            <td><?= htmlspecialchars($response['message']) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="wrapper-tanggapan">
                            <div class="no-tanggapan">Belum ada tanggapan</div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>

        <?php else: ?>
            <table class="table-pengaduan">
                <thead>
                    <tr>
                        <th style="width: 35px;">No</th>
                        <th style="width: 90px;">Kode</th>
                        <th>Judul / Isi Pengaduan</th>
                        <th style="width: 140px;">Lokasi</th>
                        <th style="width: 100px;">Pelapor</th>
                        <th style="width: 80px;">Tanggal</th>
                        <th style="width: 70px;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="7" style="text-align: center;">Tidak ada data</td>
                    </tr>
                </tbody>
            </table>
        <?php endif; ?>

        <div class="laporan-footer">
            Dokumen ini dicetak secara elektronik
        </div>
    </div>

    <script>
        window.onload = function() {
            window.print();
        };

        if (window.matchMedia) {
            const mediaQueryList = window.matchMedia('print');
            mediaQueryList.addListener(function(mql) {
                if (!mql.matches) {
                    window.close();
                }
            });
        }

        window.onafterprint = function() {
            window.close();
        };

        setTimeout(function() {
            window.close();
        }, 10000);
    </script>
</body>

</html>