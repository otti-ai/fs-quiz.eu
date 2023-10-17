const files = [
    "https://doc.fs-quiz.eu/FS-Rules_2023_v1.1.pdf",
    "https://doc.fs-quiz.eu/FS-CV-Hybrid-Rules-Extension-2023-V1.2.pdf",
    "https://doc.fs-quiz.eu/FSAA%202023_Competition_Handbook_v0.9_230118.pdf",
    "https://doc.fs-quiz.eu/FSAA23_Registration_Procedure.pdf",
  ];

 async function fillPDF(data) {
    // https://github.com/Hopding/pdf-lib/issues/252
  
    const pdfDoc = await PDFDocument.create();
  
    const setField = (form, pdfField, value, condition = false) => {
      if (!pdfField || !value || condition) return;
      if (Array.isArray(value)) value = value.join(", ");
      if (!form.getFieldMaybe(pdfField)) return;
      return form.getTextField(pdfField).setText(value.toString());
    };
  
    const getFile = async (pdf) => {
      const baseUrl = window.location.origin.toString() + process.env.PUBLIC_URL + "/";
      const formPdfBytes = await fetch(baseUrl + pdf).then((res) => res.arrayBuffer());
      const currentDocument = await PDFDocument.load(formPdfBytes);
  
      const form = currentDocument.getForm();
  
      form.flatten();
      await currentDocument.save();
  
      const coppiedPages = await pdfDoc.copyPages(currentDocument, currentDocument.getPageIndices());
      coppiedPages.forEach((page) => pdfDoc.addPage(page));
      return currentDocument;
    };
  
    for (let file of files) {
      await getFile(file);
    }
  
    return await pdfDoc.save();
  }

  const getPDF = async (e) => {
    await fillPDF();
  };