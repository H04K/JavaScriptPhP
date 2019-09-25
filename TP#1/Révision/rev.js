ordreMax = 100;
ordreFinal = 10;
pascal = new Array(ordreMax + 1);
for (i = 0; i < pascal.length; i++) {
    pascal[i] = 0;
}

pascal[0] = 1;
pascal[1] = 1;
document.write("0&nbsp;&nbsp;1<br/>");
document.write("1&nbsp;&nbsp;1&nbsp;1<br/>");
for (ordre = 2; ordre <= ordreFinal; ordre++) {
    for (i = ordre ; i >= 1; i--) {
        pascal[i] = pascal[i - 1] + pascal[i];
    }
    document.write(ordre + "&nbsp");
    for (i = 0; i <= ordre; i++) {
        document.write("&nbsp" + pascal[i]);
    }
    document.write("<br/>");
}