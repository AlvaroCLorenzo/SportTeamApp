function generateHash(plainText) {
 
    var md = forge.md.sha256.create();

    md.start();

    md.update(plainText, "utf8");

    var hashText = md.digest().toHex();

    return hashText;
}