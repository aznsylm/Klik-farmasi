<!DOCTYPE html>
<html>
<head>
    <title>Laporan Tekanan Darah - {{ $user->name }}</title>
    <style>
        body { margin: 0; padding: 0; font-family: Arial, sans-serif; }
        .header { background: #0b5e91; color: white; padding: 10px 20px; display: flex; justify-content: space-between; align-items: center; }
        .header h1 { margin: 0; font-size: 18px; }
        .btn { background: white; color: #0b5e91; border: none; padding: 8px 16px; border-radius: 4px; text-decoration: none; }
        embed { width: 100%; height: calc(100vh - 60px); }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Tekanan Darah - {{ $user->name }}</h1>
        <a href="javascript:history.back()" class="btn">Kembali</a>
    </div>
    <embed src="data:application/pdf;base64,{{ $pdfBase64 }}" width="100%" height="100%" type="application/pdf">
</body>
</html>