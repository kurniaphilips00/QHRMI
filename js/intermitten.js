function hitung_intermitten() {
    let awal = document.getElementById('tgl_awal').value;
    if (awal!="") {
            const tglawal = new Date(document.getElementById('tgl_awal').value);
            const tglakhir = new Date(document.getElementById('tgl_akhir').value);
            let time_difference = tglakhir.getTime() - tglawal.getTime();  
            let Years_difference = 0;
            let SisaBulan = 0;
            let SisaHari = 0;
            var inter = "( ";
            //calculate days difference by dividing total milliseconds in a day  
            let days_difference = time_difference / (1000 * 60 * 60 * 24);  
            let Months_difference = Math.floor(days_difference / 30);
            console.log(Months_difference.toString());
            if (Months_difference > 12) {
                Years_difference = Math.floor(Months_difference / 12); 
                SisaBulan = Months_difference % 12;
                SisaHari = days_difference - ((Years_difference * 360) + (SisaBulan * 30));
                inter += Years_difference + " tahun ";
                inter += SisaBulan + " bulan ";
                inter += SisaHari + " hari ";
            }
            else if (Months_difference > 0) {
                SisaHari = days_difference % 30;
                inter += Months_difference + " bulan ";
                inter += SisaHari + " hari ";
            }
            else {
                inter += days_difference + " hari ";
            }
            inter+=" )";
            let tahuntglakhir = tglakhir.getFullYear();
            let bulantglakhir = tglakhir.getMonth() + 1; // Months start at 0
            let haritglakhir = tglakhir.getDate();
            let tglSelesai = tahuntglakhir + '-' + bulantglakhir + '-' + haritglakhir;
            document.getElementById('intermitten').value = inter;
            document.getElementById('jmlbln').value = Months_difference;
    };
    
}
function IsiNama() {
    const sel = document.getElementById("ta_ID");
    const teks= sel.options[sel.selectedIndex].text;
    document.getElementById("Nama_Personil").value=teks;
}
function IsiID() {
    
    let ta = document.getElementById('ta_ID').value;
    const sel = document.getElementById("ta_ID");
    sel.options[sel.selectedIndex].text=ta;
}
function halo() {
    const tglawal = new Date(document.getElementById('tgl_awal').value);
    let tahuntglawal = tglawal.getFullYear();
    let bulantglaw = tglawal.getMonth() + 1; // Months start at 0
    let haritglaw = tglawal.getDate(); 
    let tgl = tahuntglawal + '-' + bulantglaw + '-' + haritglaw;
    document.getElementById('mulai').value = tgl;
}
function tambah() {
    var sel = document.getElementById("proj");
    var teks= sel.options[sel.selectedIndex].text;
    document.getElementById("aktifitas").value=teks;
    let vproject = document.getElementById("proj").value;
}