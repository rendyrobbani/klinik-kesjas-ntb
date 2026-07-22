import {useApplicationContext} from "../../hook/useApplicationContext.tsx";
import {useEffect, useRef, useState} from "react";
import type {LayananResponse} from "./LayananResponse.ts";
import {ValueOfStringUtil} from "../../util/ValueOfStringUtil.ts";
import clsx from "clsx";
import EditSVG from "../../assets/edit.svg?react";
import PrintSVG from "../../assets/print.svg?react";
import DeleteSVG from "../../assets/delete.svg?react";
import {PageNumber} from "../../components/page-number/PageNumber.tsx";
import type {PageNumberRef} from "../../components/page-number/PageNumberRef.tsx";
import {SearchUtil} from "../../util/SearchUtil.ts";
import {Dialog} from "../../components/dialog/Dialog.tsx";
import {Link} from "react-router-dom";

export const Home = () => {

    const applicationContext = useApplicationContext();

    const findRef = useRef<null | HTMLInputElement>(null);
    const sizeRef = useRef<null | HTMLSelectElement>(null);
    const pageRef = useRef<null | PageNumberRef>(null);

    const [find, setFind] = useState("");
    const [page, setPage] = useState(1);
    const [size, setSize] = useState(10);

    const [listLayanan, setListLayanan] = useState<null | LayananResponse[]>(null);
    const [rows, setRows] = useState<LayananResponse[]>([]);

    const handleDelete = async (row: LayananResponse) => {
        await applicationContext!.openDialog(
            <Dialog title={"Hapus"} handleReject={applicationContext!.closeDialog}>
                <div className={"flex items-center gap-4 border-y border-slate-200 py-4 min-w-80 max-w-160"}>
                    <div className={"w-15 h-15 min-w-15 min-h-15 rounded bg-red-500 flex items-center justify-center"}>
                        <DeleteSVG className={"w-8 h-8 fill-white"}/>
                    </div>
                    <div>
                        <p>Anda akan menghapus data pelayanan</p>
                        <p>
                            <span className={"font-medium"}>{row.nama}</span>
                            <span>&nbsp;?</span>
                        </p>
                    </div>
                </div>
                <div className={"flex justify-end gap-2 py-4"}>
                    <button className={"w-24 h-10 rounded duration-150 bg-red-500 hover:bg-red-400 focus:ring-4 focus:ring-red-700 text-white"} onClick={async e => {
                        e.currentTarget.blur();
                        try {
                            applicationContext!.showLoading = true;

                            fetch(`http://localhost:8080/api/layanan/${row.id}`, {
                                headers: {
                                    "Accept": "application/json",
                                    "Authorization": `Bearer ${applicationContext?.token ?? ""}`
                                },
                                method: "DELETE",
                                credentials: "include"
                            }).then(response => {
                                if (response.ok) {
                                    applicationContext!.closeDialog();
                                    applicationContext!.openSuccessModal(`Data pelayanan a.n. <b>${row.nama}</b> berhasil dihapus`);
                                    setListLayanan(null);
                                } else {
                                    applicationContext!.openErrorModal(`Data pelayanan a.n. <b>${row.nama}</b> gagal dihapus`);
                                    applicationContext!.showLoading = false;
                                }
                            });
                        } catch {
                        }
                    }}
                    >
                        Hapus
                    </button>
                    <button className={"w-24 h-10 rounded duration-150 bg-neutral-500 hover:bg-neutral-400 focus:ring-4 focus:ring-neutral-700 text-white"} onClick={() => applicationContext!.closeDialog()}>
                        Batal
                    </button>
                </div>
            </Dialog>
        );
    }

    useEffect(() => {
        // const token = applicationContext?.token ?? null;
        // if (token == null || token == "") navigate("/login");
    }, []);

    useEffect(() => {
        if (listLayanan != null) return;
        applicationContext!.showLoading = true;
        fetch("http://localhost:8080/api/layanan", {
            headers: {
                "Accept": "application/json",
                "Authorization": `Bearer ${applicationContext?.token ?? ""}`
            },
            method: "GET",
            credentials: "include"
        }).then(response => {
            if (response.ok) response.json().then((body: LayananResponse[]) => {
                setListLayanan(body)
                applicationContext!.showLoading = false;
            });
            else {
                if (response.status == 401) {
                    applicationContext!.token = null;
                    applicationContext!.showLoading = false;
                    // @ts-ignore
                    window.location = "/login";
                } else {
                    response.json().then((error: { message: string }) => {
                        applicationContext!.openErrorModal(error.message);
                        applicationContext!.showLoading = false;
                    });
                }
            }
        }).catch(error => {
            applicationContext!.openErrorModal(error.message);
            applicationContext!.showLoading = false;
        });
    }, [listLayanan]);

    useEffect(() => {
        const filter: LayananResponse[] = [];
        (listLayanan ?? []).forEach(row => {
            let value = 0;
            if (SearchUtil.compare(find, row.tanggal)) value++;
            // if (SearchUtil.compare(find, row.nomorSurat)) value++;
            // if (SearchUtil.compare(find, row.tanggalSurat)) value++;
            // if (SearchUtil.compare(find, row.komunitas)) value++;
            if (SearchUtil.compare(find, row.nama)) value++;
            // if (SearchUtil.compare(find, row.pekerjaan)) value++;
            if (SearchUtil.compare(find, row.alamat)) value++;
            // if (SearchUtil.compare(find, row.telepon)) value++;
            if (SearchUtil.compare(find, row.permasalahan)) value++;
            // if (SearchUtil.compare(find, row.solusi)) value++;
            // if (SearchUtil.compare(find, row.idPetugas)) value++;
            // if (SearchUtil.compare(find, row.namaPetugas)) value++;
            // if (SearchUtil.compare(find, row.createdAt)) value++;
            // if (SearchUtil.compare(find, row.createdBy)) value++;
            // if (SearchUtil.compare(find, row.updatedAt)) value++;
            // if (SearchUtil.compare(find, row.updatedBy)) value++;
            // if (SearchUtil.compare(find, row.deletedAt)) value++;
            // if (SearchUtil.compare(find, row.deletedBy)) value++;
            if (value > 0) filter.push(row);
        });

        const slice: LayananResponse[] = [];
        for (let i = ((page - 1) * size); i < filter.length; i++) {
            slice.push(filter[i]);
            if (slice.length == size) break;
        }

        setRows(slice);
        if (pageRef.current) {
            pageRef.current.value = page;
            pageRef.current.total = Math.ceil(filter.length / size);
        }
    }, [listLayanan, find, page, size]);

    return (
        <div className={"w-full h-fit py-4 flex flex-col gap-4"}>
            <div className={"w-full flex items-center justify-center"}>
                <div className={"w-full lg:w-1/2 flex items-center justify-start"}>
                    <input ref={findRef}
                           className={"w-full h-10 px-4 lg:w-80 rounded duration-150 border border-neutral-300 focus:ring-4 focus:ring-red-700"}
                           placeholder={"Cari"}
                           onInput={e => {
                               setFind(e.currentTarget.value.trim());
                               setPage(1);
                           }}
                    />
                </div>
                <div className={"w-full lg:w-1/2 flex items-center justify-end"}>
                    <Link to={"/tambah"}>
                        <button className={"w-24 h-10 rounded duration-150 bg-red-900 focus:ring-4 focus:ring-red-700 text-white"}>
                            Tambah
                        </button>
                    </Link>
                </div>
            </div>
            <div className={"w-full flex items-center justify-center"}>
                <div className={"w-full border border-neutral-300"}>
                    <table className={"w-full"}>
                        <thead className={"bg-red-900 text-white"}>
                        <tr className={"h-14"}>
                            <th className={"w-36"}>
                                Tanggal
                            </th>
                            <th className={"w-80"}>
                                Nama
                            </th>
                            <th className={"w-20"}>
                                L/P
                            </th>
                            <th className={"w-80"}>
                                Alamat
                            </th>
                            <th>
                                Permasalahan
                            </th>
                            <th className={"w-48"}>
                                Aksi
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        {rows.map((row, index) => (
                            <tr key={row.id}>
                                <td className={clsx("px-4 py-2 place-content-start", index > 0 && "border-t border-t-neutral-300", "w-36 text-center")}>
                                    {ValueOfStringUtil.blankIfNull(row.tanggal).substring(0, Math.min(10, ValueOfStringUtil.blankIfNull(row.tanggal).length))}
                                </td>
                                <td className={clsx("px-4 py-2 place-content-start", index > 0 && "border-t border-t-neutral-300", "border-l border-l-neutral-300", "w-80")}>
                                    {ValueOfStringUtil.escapeIfNull(row.nama)}
                                </td>
                                <td className={clsx("px-4 py-2 place-content-start", index > 0 && "border-t border-t-neutral-300", "border-l border-l-neutral-300", "w-20 text-center")}>
                                    {ValueOfStringUtil.escapeIfNull(row.jenis == 1 ? "L" : row.jenis == 2 ? "P" : null)}
                                </td>
                                <td className={clsx("px-4 py-2 place-content-start", index > 0 && "border-t border-t-neutral-300", "border-l border-l-neutral-300", "w-80")}>
                                    {ValueOfStringUtil.escapeIfNull(row.alamat)}
                                </td>
                                <td className={clsx("px-4 py-2 place-content-start", index > 0 && "border-t border-t-neutral-300", "border-l border-l-neutral-300")}>
                                    {ValueOfStringUtil.escapeIfNull(row.permasalahan)}
                                </td>
                                <td className={clsx("px-4 py-2 place-content-start", index > 0 && "border-t border-t-neutral-300", "border-l border-l-neutral-300", "w-48")}>
                                    <div className={"flex items-center justify-center gap-2"}>
                                        <Link to={`/edit/${row.id}`}>
                                            <button className={"w-10 h-10 rounded duration-150 flex items-center justify-center bg-yellow-200 fill-yellow-500 hover:bg-yellow-500 hover:fill-white"}>
                                                <EditSVG className={"w-5 h-5 fill-inherit"}/>
                                            </button>
                                        </Link>
                                        <button className={"w-10 h-10 rounded duration-150 flex items-center justify-center bg-red-200 fill-red-500 hover:bg-red-500 hover:fill-white"} onClick={() => handleDelete(row)}>
                                            <DeleteSVG className={"w-5 h-5 fill-inherit"}/>
                                        </button>
                                        <button className={"w-10 h-10 rounded duration-150 flex items-center justify-center bg-blue-200 fill-blue-500 hover:bg-blue-500 hover:fill-white"}>
                                            <PrintSVG className={"w-5 h-5 fill-inherit"}/>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        ))}
                        </tbody>
                    </table>
                </div>
            </div>
            <div className={"w-full flex items-center justify-center"}>
                <div className={"w-full lg:w-1/2 flex items-center justify-start"}>
                    <select ref={sizeRef}
                            className={"w-20 h-10 rounded border border-neutral-300 text-center"}
                            onChange={e => {
                                setSize(Number(e.currentTarget.value));
                                setPage(1);
                            }}
                    >
                        <option>10</option>
                        <option>20</option>
                        <option>50</option>
                    </select>
                </div>
                <div className={"w-full lg:w-1/2 flex items-center justify-end"}>
                    <PageNumber ref={pageRef} defaultValue={1} defaultTotal={1} onClick={page => {
                        setPage(page);
                    }}/>
                </div>
            </div>
        </div>
    );

}