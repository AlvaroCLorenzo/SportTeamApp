function generateHash() {
    var plainText = document.getElementById('plainText').value;
    var md = forge.md.sha256.create();
    md.start();
    md.update(plainText, "utf8");
    var hashText = md.digest().toHex();
    document.getElementById("hashText").innerHTML = hashText;
}