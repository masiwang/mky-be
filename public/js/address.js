var provinsi = document.getElementById('provinsi')
var provinsiList = document.getElementById('provinsiList')
var kabupaten = document.getElementById('kabupaten')
var kabupatenList = document.getElementById('kabupatenList')
var kecamatan = document.getElementById('kecamatan')
var kecamatanList = document.getElementById('kecamatanList')
var kelurahan = document.getElementById('kelurahan')
var kelurahanList = document.getElementById('kelurahanList')
var kodepos = document.getElementById('kodepos')
var _token = document.getElementById('_csrf')

function getData(url, element) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        var html = '';
        var response = JSON.parse(this.response)
        response.map(function (data) {
            html += `<option value="${data.data}"></option>`
        })
        element.innerHTML = html
    }
    xhttp.open('GET', url, true)
    xhttp.send()
}

document.addEventListener("DOMContentLoaded", function () {
    getData('/address/', provinsiList)
});

provinsi.onchange = function () {
    getData('/address/' + provinsi.value, kabupatenList)
}

kabupaten.onchange = function () {
    getData('/address/' + provinsi.value + '/' + kabupaten.value, kecamatanList)
}

kecamatan.onchange = function () {
    getData('/address/' + provinsi.value + '/' + kabupaten.value + '/' + kecamatan.value, kelurahanList)
}

kelurahan.onchange = function () {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        var html = '';
        var response = JSON.parse(this.response)
        kodepos.value = response.data
    }
    xhttp.open('GET', '/address/' + provinsi.value + '/' + kabupaten.value + '/' + kecamatan.value + '/' + kelurahan.value, true)
    xhttp.send()
}