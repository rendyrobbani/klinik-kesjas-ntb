import {BorderStyle, Document, ImageRun, Packer, Paragraph, Table, TableCell, TableRow, TextRun, WidthType} from "docx";
import type {LayananResponse} from "../pages/home/LayananResponse.ts";
import logoPolri from "../assets/logo-polri.png";

const convertMillimetersToTwip = (mm: number) => {
    return mm * 56.7;
}

const noborder = () => ({
    top: {style: BorderStyle.NONE, size: 0, color: "ffffff"},
    left: {style: BorderStyle.NONE, size: 0, color: "ffffff"},
    right: {style: BorderStyle.NONE, size: 0, color: "ffffff"},
    bottom: {style: BorderStyle.NONE, size: 0, color: "ffffff"},
});

export const printLayanan = async (row: LayananResponse): Promise<Blob> => {
    const logo = await (await fetch(logoPolri)).arrayBuffer();
    const date = new Date(row.tanggal!);

    let hari = "";
    switch (date.getDay()) {
        case 0:
            hari = "Minggu";
            break;
        case 1:
            hari = "Senin";
            break;
        case 2:
            hari = "Selasa";
            break;
        case 3:
            hari = "Rabu";
            break;
        case 4:
            hari = "Kamis";
            break;
        case 5:
            hari = "Jumat";
            break;
        case 6:
            hari = "Sabtu";
            break;
        case 7:
            hari = "Minggu";
            break;
    }

    let bulan = "";
    switch (date.getMonth()) {
        case 0:
            bulan = "Januari";
            break;
        case 1:
            bulan = "Februari";
            break;
        case 2:
            bulan = "Maret";
            break;
        case 3:
            bulan = "April";
            break;
        case 4:
            bulan = "Mei";
            break;
        case 5:
            bulan = "Juni";
            break;
        case 6:
            bulan = "Juli";
            break;
        case 7:
            bulan = "Agustus";
            break;
        case 8:
            bulan = "September";
            break;
        case 9:
            bulan = "Oktober";
            break;
        case 10:
            bulan = "November";
            break;
        case 11:
            bulan = "Desember";
            break;
    }

    const docx = new Document({
        styles: {
            default: {
                document: {
                    run: {
                        font: "Arial",
                        size: 20,
                    }
                }
            }
        },
        sections: [
            {
                properties: {},
                children: [
                    new Table({
                        width: {
                            size: 100,
                            type: WidthType.PERCENTAGE,
                        },
                        rows: [
                            new TableRow({
                                children: [
                                    new TableCell({
                                        borders: noborder(),
                                        children: [
                                            new Paragraph({
                                                children: [
                                                    new ImageRun({
                                                        data: logo,
                                                        type: "png",
                                                        transformation: {
                                                            width: 75,
                                                            height: 75
                                                        },
                                                    }),
                                                ],
                                                alignment: "center",
                                            }),
                                            new Paragraph({
                                                children: [
                                                    new TextRun({
                                                        text: "KEPOLISIAN NEGARA REPUBLIK INDONESIA",
                                                        bold: true,
                                                    })
                                                ],
                                                alignment: "center",
                                            }),
                                            new Paragraph({
                                                children: [
                                                    new TextRun({
                                                        text: "DAERAH NUSA TENGGARA BARAT",
                                                        bold: true,
                                                    })
                                                ],
                                                alignment: "center",
                                            }),
                                            new Paragraph({
                                                children: [
                                                    new TextRun({
                                                        text: "BIDANG KEDOKTERAN DAN KESEHATAN",
                                                        bold: true,
                                                        underline: {
                                                            type: "single",
                                                        }
                                                    })
                                                ],
                                                alignment: "center",
                                            }),
                                        ],
                                    }),
                                    new TableCell({
                                        borders: noborder(),
                                        children: [
                                            new Paragraph({
                                                text: `Kunjungan ke ${row.nomor}`,
                                                alignment: "end",
                                            }),
                                        ],
                                    }),
                                ],
                            }),
                        ],
                    }),
                    new Paragraph("\n"),
                    new Paragraph("\n"),
                    new Paragraph({
                        children: [
                            new TextRun({
                                text: "LEMBAR KUNJUNGAN \"POLMAS PELAYANAN KESEHATAN GRATIS PRESISI POLDA NTB\"",
                                bold: true,
                            })
                        ],
                        alignment: "center",
                    }),
                    new Paragraph("\n"),
                    new Paragraph("\n"),
                    new Paragraph({
                        children: [
                            new TextRun({
                                text: [
                                    `Pada hari ini ${hari}, ${date.getDate()} ${bulan} ${date.getFullYear()}. Pukul:${date.getHours()}:${date.getMinutes()}Wita`,
                                    `Berdasarkan Surat Perintah Kapolda NTB Nomor: Sprin/818/VI/KEP./2026, tanggal 10 Juni 2026`,
                                    `tentang kegiatan Polmas Pelayanan Kesehatan Gratis Presisi Polda NTB dan Polres/ta sebagai`,
                                    `pengemban fungsi dan peran pemolisian masyarakat (POLMAS). Telah melakukan pelayanan`,
                                    `Kesehatan gratis, silaturahmi/koordinasi tatap muka dan kunjungan pada warga/ komunitas`,
                                    `tertentu:`,
                                ].join(" "),
                            }),
                        ],
                        alignment: "both",
                        indent: {
                            firstLine: convertMillimetersToTwip(10),
                        }
                    }),
                    new Paragraph({
                        children: [
                            new TextRun({
                                text: [
                                    `Nama: ${row.nama}`,
                                    row.jenis === 1 ? "Laki-laki" : row.jenis === 2 ? "Perempuan" : "",
                                    `Umur: ${row.umur} tahun`,
                                    `Pekerjaan: ${row.pekerjaan}`,
                                    `Alamat: ${row.alamat}`,
                                    `No. Telp: ${row.telepon}`,
                                    `dan telah menerima pelayanan Kesehatan/ informasi / saran / permasalahan / keluhan dari masyarakat tersebut diatas, sebagai berikut:`,
                                ].join(" "),
                            })
                        ],
                        alignment: "both",
                        indent: {
                            firstLine: convertMillimetersToTwip(10),
                        }
                    }),
                    new Paragraph("\n"),
                    new Table({
                        width: {
                            size: 100,
                            type: WidthType.PERCENTAGE,
                        },
                        rows: [
                            new TableRow({
                                tableHeader: true,
                                children: [
                                    new TableCell({
                                        width: {
                                            size: 50,
                                            type: WidthType.PERCENTAGE,
                                        },
                                        verticalAlign: "center",
                                        children: [
                                            new Paragraph({
                                                children: [
                                                    new TextRun({
                                                        text: "ASPEK",
                                                        bold: true,
                                                    }),
                                                ],
                                                alignment: "center",
                                            }),
                                        ],
                                    }),
                                    new TableCell({
                                        width: {
                                            size: 50,
                                            type: WidthType.PERCENTAGE,
                                        },
                                        verticalAlign: "center",
                                        children: [
                                            new Paragraph({
                                                children: [
                                                    new TextRun({
                                                        text: "PERMASALAHAN KESEHATAN / INFORMASI / SARAN / KELUHAN MASYARAKAT",
                                                        bold: true,
                                                    }),
                                                ],
                                                alignment: "center",
                                            }),
                                        ],
                                    }),
                                ],
                            }),
                            new TableRow({
                                children: [
                                    new TableCell({
                                        width: {
                                            size: 50,
                                            type: WidthType.PERCENTAGE,
                                        },
                                        verticalAlign: "center",
                                        children: [
                                            new Table({
                                                width: {
                                                    size: 100,
                                                    type: WidthType.PERCENTAGE,
                                                },
                                                rows: [
                                                    new TableRow({
                                                        children: [
                                                            new TableCell({
                                                                width: {
                                                                    size: 55,
                                                                    type: WidthType.PERCENTAGE,
                                                                },
                                                                borders: noborder(),
                                                                children: [
                                                                    new Paragraph({
                                                                        indent: {
                                                                            left: convertMillimetersToTwip(3),
                                                                        },
                                                                        children: [
                                                                            new TextRun({
                                                                                text: row.isPelayanan ? "✔" : "☐",
                                                                            }),
                                                                            new TextRun({
                                                                                text: " ",
                                                                            }),
                                                                            new TextRun({
                                                                                text: "Pelayanan Kesehatan",
                                                                            }),
                                                                        ],
                                                                        alignment: "start",
                                                                    }),
                                                                ],
                                                            }),
                                                            new TableCell({
                                                                width: {
                                                                    size: 45,
                                                                    type: WidthType.PERCENTAGE,
                                                                },
                                                                borders: noborder(),
                                                                children: [
                                                                    new Paragraph({
                                                                        indent: {
                                                                            left: convertMillimetersToTwip(3),
                                                                        },
                                                                        children: [
                                                                            new TextRun({
                                                                                text: row.isKamtibmas ? "✔" : "☐",
                                                                            }),
                                                                            new TextRun({
                                                                                text: " ",
                                                                            }),
                                                                            new TextRun({
                                                                                text: "Kamtibmas",
                                                                            }),
                                                                        ],
                                                                        alignment: "start",
                                                                    }),
                                                                ],
                                                            }),
                                                        ],
                                                    }),
                                                    new TableRow({
                                                        children: [
                                                            new TableCell({
                                                                width: {
                                                                    size: 55,
                                                                    type: WidthType.PERCENTAGE,
                                                                },
                                                                borders: noborder(),
                                                                children: [
                                                                    new Paragraph({
                                                                        indent: {
                                                                            left: convertMillimetersToTwip(3),
                                                                        },
                                                                        children: [
                                                                            new TextRun({
                                                                                text: row.isIdeologi ? "✔" : "☐",
                                                                            }),
                                                                            new TextRun({
                                                                                text: " ",
                                                                            }),
                                                                            new TextRun({
                                                                                text: "Ideologi",
                                                                            }),
                                                                        ],
                                                                        alignment: "start",
                                                                    }),
                                                                ],
                                                            }),
                                                            new TableCell({
                                                                width: {
                                                                    size: 45,
                                                                    type: WidthType.PERCENTAGE,
                                                                },
                                                                borders: noborder(),
                                                                children: [
                                                                    new Paragraph({
                                                                        indent: {
                                                                            left: convertMillimetersToTwip(3),
                                                                        },
                                                                        children: [
                                                                            new TextRun({
                                                                                text: row.isKriminalitas ? "✔" : "☐",
                                                                            }),
                                                                            new TextRun({
                                                                                text: " ",
                                                                            }),
                                                                            new TextRun({
                                                                                text: "Kriminalitas",
                                                                            }),
                                                                        ],
                                                                        alignment: "start",
                                                                    }),
                                                                ],
                                                            }),
                                                        ],
                                                    }),
                                                    new TableRow({
                                                        children: [
                                                            new TableCell({
                                                                width: {
                                                                    size: 55,
                                                                    type: WidthType.PERCENTAGE,
                                                                },
                                                                borders: noborder(),
                                                                children: [
                                                                    new Paragraph({
                                                                        indent: {
                                                                            left: convertMillimetersToTwip(3),
                                                                        },
                                                                        children: [
                                                                            new TextRun({
                                                                                text: row.isPolitik ? "✔" : "☐",
                                                                            }),
                                                                            new TextRun({
                                                                                text: " ",
                                                                            }),
                                                                            new TextRun({
                                                                                text: "Politik",
                                                                            }),
                                                                        ],
                                                                        alignment: "start",
                                                                    }),
                                                                ],
                                                            }),
                                                            new TableCell({
                                                                width: {
                                                                    size: 45,
                                                                    type: WidthType.PERCENTAGE,
                                                                },
                                                                borders: noborder(),
                                                                children: [
                                                                    new Paragraph({
                                                                        indent: {
                                                                            left: convertMillimetersToTwip(3),
                                                                        },
                                                                        children: [
                                                                            new TextRun({
                                                                                text: row.isTibcarLantas ? "✔" : "☐",
                                                                            }),
                                                                            new TextRun({
                                                                                text: " ",
                                                                            }),
                                                                            new TextRun({
                                                                                text: "Tibcar Lantas",
                                                                            }),
                                                                        ],
                                                                        alignment: "start",
                                                                    }),
                                                                ],
                                                            }),
                                                        ],
                                                    }),
                                                    new TableRow({
                                                        children: [
                                                            new TableCell({
                                                                width: {
                                                                    size: 55,
                                                                    type: WidthType.PERCENTAGE,
                                                                },
                                                                borders: noborder(),
                                                                children: [
                                                                    new Paragraph({
                                                                        indent: {
                                                                            left: convertMillimetersToTwip(3),
                                                                        },
                                                                        children: [
                                                                            new TextRun({
                                                                                text: row.isSosial ? "✔" : "☐",
                                                                            }),
                                                                            new TextRun({
                                                                                text: " ",
                                                                            }),
                                                                            new TextRun({
                                                                                text: "Sosial",
                                                                            }),
                                                                        ],
                                                                        alignment: "start",
                                                                    }),
                                                                ],
                                                            }),
                                                            new TableCell({
                                                                width: {
                                                                    size: 45,
                                                                    type: WidthType.PERCENTAGE,
                                                                },
                                                                borders: noborder(),
                                                                children: [
                                                                    new Paragraph({
                                                                        indent: {
                                                                            left: convertMillimetersToTwip(3),
                                                                        },
                                                                        children: [
                                                                            new TextRun({
                                                                                text: row.isPrilakuPolri ? "✔" : "☐",
                                                                            }),
                                                                            new TextRun({
                                                                                text: " ",
                                                                            }),
                                                                            new TextRun({
                                                                                text: "Prilaku Polri",
                                                                            }),
                                                                        ],
                                                                        alignment: "start",
                                                                    }),
                                                                ],
                                                            }),
                                                        ],
                                                    }),
                                                    new TableRow({
                                                        children: [
                                                            new TableCell({
                                                                width: {
                                                                    size: 55,
                                                                    type: WidthType.PERCENTAGE,
                                                                },
                                                                borders: noborder(),
                                                                children: [
                                                                    new Paragraph({
                                                                        indent: {
                                                                            left: convertMillimetersToTwip(3),
                                                                        },
                                                                        children: [
                                                                            new TextRun({
                                                                                text: row.isBudaya ? "✔" : "☐",
                                                                            }),
                                                                            new TextRun({
                                                                                text: " ",
                                                                            }),
                                                                            new TextRun({
                                                                                text: "Budaya",
                                                                            }),
                                                                        ],
                                                                        alignment: "start",
                                                                    }),
                                                                ],
                                                            }),
                                                            new TableCell({
                                                                width: {
                                                                    size: 45,
                                                                    type: WidthType.PERCENTAGE,
                                                                },
                                                                borders: noborder(),
                                                                children: [
                                                                    new Paragraph({
                                                                        indent: {
                                                                            left: convertMillimetersToTwip(3),
                                                                        },
                                                                        children: [
                                                                            new TextRun({
                                                                                text: row.isYanPolri ? "✔" : "☐",
                                                                            }),
                                                                            new TextRun({
                                                                                text: " ",
                                                                            }),
                                                                            new TextRun({
                                                                                text: "Yan Polri",
                                                                            }),
                                                                        ],
                                                                        alignment: "start",
                                                                    }),
                                                                ],
                                                            }),
                                                        ],
                                                    }),
                                                    new TableRow({
                                                        children: [
                                                            new TableCell({
                                                                width: {
                                                                    size: 55,
                                                                    type: WidthType.PERCENTAGE,
                                                                },
                                                                borders: noborder(),
                                                                children: [
                                                                    new Paragraph({
                                                                        indent: {
                                                                            left: convertMillimetersToTwip(3),
                                                                        },
                                                                        children: [
                                                                            new TextRun({
                                                                                text: row.isAgama ? "✔" : "☐",
                                                                            }),
                                                                            new TextRun({
                                                                                text: " ",
                                                                            }),
                                                                            new TextRun({
                                                                                text: "Agama",
                                                                            }),
                                                                        ],
                                                                        alignment: "start",
                                                                    }),
                                                                ],
                                                            }),
                                                            new TableCell({
                                                                width: {
                                                                    size: 45,
                                                                    type: WidthType.PERCENTAGE,
                                                                },
                                                                borders: noborder(),
                                                                children: [
                                                                    new Paragraph({
                                                                        indent: {
                                                                            left: convertMillimetersToTwip(3),
                                                                        },
                                                                        children: [
                                                                            new TextRun({
                                                                                text: row.isLainLain ? "✔" : "☐",
                                                                            }),
                                                                            new TextRun({
                                                                                text: " ",
                                                                            }),
                                                                            new TextRun({
                                                                                text: "Lain-lain",
                                                                            }),
                                                                        ],
                                                                        alignment: "start",
                                                                    }),
                                                                ],
                                                            }),
                                                        ],
                                                    }),
                                                ],
                                            })
                                        ],
                                    }),
                                    new TableCell({
                                        width: {
                                            size: 50,
                                            type: WidthType.PERCENTAGE,
                                        },
                                        verticalAlign: "top",
                                        children: [
                                            new Table({
                                                width: {
                                                    size: 100,
                                                    type: WidthType.PERCENTAGE,
                                                },
                                                rows: [
                                                    new TableRow({
                                                        children: [
                                                            new TableCell({
                                                                borders: noborder(),
                                                                columnSpan: 2,
                                                                children: [
                                                                    new Paragraph({
                                                                        text: row.permasalahan!,
                                                                        indent: {
                                                                            left: convertMillimetersToTwip(2),
                                                                        },
                                                                        alignment: "both",
                                                                    })
                                                                ],
                                                            })
                                                        ],
                                                    }),
                                                    new TableRow({
                                                        children: [
                                                            new TableCell({
                                                                borders: noborder(),
                                                                columnSpan: 2,
                                                                children: [
                                                                    new Paragraph("\n")
                                                                ],
                                                            })
                                                        ],
                                                    }),
                                                    new TableRow({
                                                        children: [
                                                            new TableCell({
                                                                borders: noborder(),
                                                                children: [
                                                                    new Paragraph({
                                                                        text: "Tanda Tangan",
                                                                        alignment: "center",
                                                                    })
                                                                ],
                                                            }),
                                                            new TableCell({
                                                                borders: noborder(),
                                                                children: [
                                                                    new Paragraph({
                                                                        text: "Tanda Tangan",
                                                                        alignment: "center",
                                                                    })
                                                                ],
                                                            }),
                                                        ],
                                                    }),
                                                    new TableRow({
                                                        children: [
                                                            new TableCell({
                                                                borders: noborder(),
                                                                children: [
                                                                    new Paragraph({
                                                                        text: "Petugas",
                                                                        alignment: "center",
                                                                    })
                                                                ],
                                                            }),
                                                            new TableCell({
                                                                borders: noborder(),
                                                                children: [
                                                                    new Paragraph({
                                                                        text: "Warga",
                                                                        alignment: "center",
                                                                    })
                                                                ],
                                                            }),
                                                        ],
                                                    }),
                                                    new TableRow({
                                                        children: [
                                                            new TableCell({
                                                                borders: noborder(),
                                                                columnSpan: 2,
                                                                children: [
                                                                    new Paragraph("\n")
                                                                ],
                                                            })
                                                        ],
                                                    }),
                                                    new TableRow({
                                                        children: [
                                                            new TableCell({
                                                                borders: noborder(),
                                                                columnSpan: 2,
                                                                children: [
                                                                    new Paragraph("\n")
                                                                ],
                                                            })
                                                        ],
                                                    }),
                                                    new TableRow({
                                                        children: [
                                                            new TableCell({
                                                                borders: noborder(),
                                                                children: [
                                                                    new Paragraph({
                                                                        text: row.namaPetugas!,
                                                                        alignment: "center",
                                                                    })
                                                                ],
                                                            }),
                                                            new TableCell({
                                                                borders: noborder(),
                                                                children: [
                                                                    new Paragraph({
                                                                        text: row.nama!,
                                                                        alignment: "center",
                                                                    })
                                                                ],
                                                            }),
                                                        ],
                                                    }),
                                                ],
                                            })
                                        ],
                                    }),
                                ],
                            }),
                        ],
                    }),
                ],
            },
        ],
    });
    return await Packer.toBlob(docx);
}