async function generateHash() {
    alert("kek");
    console.log(document.getElementById('plainText'));
    var plainText = document.getElementById('plainText').value;
    var md = forge.md.sha256.create();
    md.start();
    md.update(plainText, "utf8");
    var hashText = md.digest().toHex();
    return hashText;
}