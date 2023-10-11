const generatePdf = async (name, id) => {
  const { PDFDocument, rgb } = PDFLib;
  const exBytes = await fetch("./cert.pdf").then((res) => {
    return res.arrayBuffer();
  });
  const exFont = await fetch("./Sanchez-Regular.ttf").then((res) => {
    return res.arrayBuffer();
  });
  const pdfDoc = await PDFDocument.load(exBytes);
  pdfDoc.registerFontkit(fontkit);
  const myFont = await pdfDoc.embedFont(exFont);
  const pages = pdfDoc.getPages();
  const FirstPg = pages[0];
  FirstPg.drawText(name, {
    x: 270,
    y: 280,
    size: 40,
    font: myFont,
    color: rgb(0, 0, 0),
  });
  FirstPg.drawText(id, {
    x: 650,
    y: 500,
    size: 20,
    font: myFont,
    color: rgb(0, 0, 0),
  });
  const uri = await pdfDoc.saveAsBase64({ dataUri: true });

  const pdfIframe = document.querySelector("#certificatepdf");
    pdfIframe.src = uri;
};
