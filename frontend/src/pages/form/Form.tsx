// @ts-nocheck
import type {FormType} from "./FormType.ts";
import {Fragment, useEffect, useRef, useState} from "react";
import clsx from "clsx";
import {Link, useParams} from "react-router-dom";
import {useApplicationContext} from "../../hook/useApplicationContext.tsx";
import type {LayananResponse} from "../home/LayananResponse.ts";
import ImageSVG from "../../assets/image.svg?react";
import {getApiHost} from "../../hook/config.ts";

export const Form = (props: { type: FormType }) => {

    const applicationContext = useApplicationContext();

    const {id: _id} = useParams();
    const id = Number(_id);

    const [layananResponse, setLayananResponse] = useState<null | LayananResponse>(null)

    const nomorRef = useRef<null | HTMLInputElement>(null);
    const [nomorError, setNomorError] = useState(false);

    const tanggalRef = useRef<null | HTMLInputElement>(null);
    const [tanggalError, setTanggalError] = useState(false);

    const namaRef = useRef<null | HTMLInputElement>(null);
    const [namaError, setNamaError] = useState(false);

    const jenisRef = useRef<null | HTMLSelectElement>(null);
    const [jenisError, setJenisError] = useState(false);

    const umurRef = useRef<null | HTMLInputElement>(null);
    const [umurError, setUmurError] = useState(false);

    const pekerjaanRef = useRef<null | HTMLInputElement>(null);
    const [pekerjaanError, setPekerjaanError] = useState(false);

    const alamatRef = useRef<null | HTMLInputElement>(null);
    const [alamatError, setAlamatError] = useState(false);

    const teleponRef = useRef<null | HTMLInputElement>(null);
    const [teleponError, setTeleponError] = useState(false);

    const pelayananRef = useRef<null | HTMLInputElement>(null);
    const [pelayananError, setPelayananError] = useState(false);

    const ideologiRef = useRef<null | HTMLInputElement>(null);
    const [ideologiError, setIdeologiError] = useState(false);

    const politikRef = useRef<null | HTMLInputElement>(null);
    const [politikError, setPolitikError] = useState(false);

    const sosialRef = useRef<null | HTMLInputElement>(null);
    const [sosialError, setSosialError] = useState(false);

    const budayaRef = useRef<null | HTMLInputElement>(null);
    const [budayaError, setBudayaError] = useState(false);

    const agamaRef = useRef<null | HTMLInputElement>(null);
    const [agamaError, setAgamaError] = useState(false);

    const kamtibmasRef = useRef<null | HTMLInputElement>(null);
    const [kamtibmasError, setKamtibmasError] = useState(false);

    const kriminalitasRef = useRef<null | HTMLInputElement>(null);
    const [kriminalitasError, setKriminalitasError] = useState(false);

    const tibcarLantasRef = useRef<null | HTMLInputElement>(null);
    const [tibcarLantasError, setTibcarLantasError] = useState(false);

    const prilakuPolriRef = useRef<null | HTMLInputElement>(null);
    const [prilakuPolriError, setPrilakuPolriError] = useState(false);

    const yanPolriRef = useRef<null | HTMLInputElement>(null);
    const [yanPolriError, setYanPolriError] = useState(false);

    const lainLainRef = useRef<null | HTMLInputElement>(null);
    const [lainLainError, setLainLainError] = useState(false);

    const permasalahanRef = useRef<null | HTMLInputElement>(null);
    const [permasalahanError, setPermasalahanError] = useState(false);

    const solusiRef = useRef<null | HTMLInputElement>(null);
    const [solusiError, setSolusiError] = useState(false);

    const dokumentasiRef = useRef<null | HTMLInputElement>(null);
    const [dokumentasiError, setDokumentasiError] = useState(false);

    const handleSubmit = async () => {
        applicationContext!.showLoading = true;

        const dokumentasi = (dokumentasiRef.current?.files ?? [])[0] ?? null;

        const request = {
            nomor: Number(nomorRef.current?.value ?? null),
            tanggal: tanggalRef.current?.value ?? null,
            nama: namaRef.current?.value ?? null,
            jenis: Number(jenisRef.current?.value ?? 0),
            umur: Number(umurRef.current?.value ?? null),
            pekerjaan: pekerjaanRef.current?.value ?? null,
            alamat: alamatRef.current?.value ?? null,
            telepon: teleponRef.current?.value ?? null,
            isPelayanan: pelayananRef.current?.checked ?? false,
            isIdeologi: ideologiRef.current?.checked ?? false,
            isPolitik: politikRef.current?.checked ?? false,
            isSosial: sosialRef.current?.checked ?? false,
            isBudaya: budayaRef.current?.checked ?? false,
            isAgama: agamaRef.current?.checked ?? false,
            isKamtibmas: kamtibmasRef.current?.checked ?? false,
            isKriminalitas: kriminalitasRef.current?.checked ?? false,
            isTibcarLantas: tibcarLantasRef.current?.checked ?? false,
            isPrilakuPolri: prilakuPolriRef.current?.checked ?? false,
            isYanPolri: yanPolriRef.current?.checked ?? false,
            isLainLain: lainLainRef.current?.checked ?? false,
            permasalahan: permasalahanRef.current?.value ?? null,
            solusi: solusiRef.current?.value ?? null,
            dokumentasiExt: dokumentasi == null ? null : dokumentasi.name.substring(dokumentasi.name.lastIndexOf(".") + 1),
        };

        const form = new FormData();
        form.append("data", JSON.stringify(request));
        form.append("file", dokumentasi);

        let response: null | Response = null;
        if (props.type === "create") response = await fetch(`${getApiHost()}/layanan`, {
            headers: {
                "Accept": "application/json",
                "Authorization": `Bearer ${applicationContext?.token ?? ""}`
            },
            method: "POST",
            credentials: "include",
            body: form,
        });
        if (props.type === "update") response = await fetch(`${getApiHost()}/layanan/${id}`, {
            headers: {
                "Accept": "application/json",
                "Authorization": `Bearer ${applicationContext?.token ?? ""}`
            },
            method: "POST",
            credentials: "include",
            body: form,
        });

        if (!!response) {
            if (response.ok) {
                applicationContext!.openSuccessModal(`Data pelayanan a.n. <b>${namaRef.current!.value!}</b> berhasil disimpan`);
                window.location = "/";
            } else {
                if (response.status === 401) {
                    applicationContext!.showLoading = false;
                    applicationContext!.token = null;
                    window.location = "/login";
                    return;
                } else if (response.status === 400) {
                    applicationContext!.showLoading = false;
                    const body: null | undefined | Record<string, string[]> = await response.json();
                    if (!!body) {
                        Object.entries(body).forEach(([field, messages]) => {
                            if (field === "Nomor Kunjungan") setNomorError(true);
                            if (field === "Tanggal") setTanggalError(true);
                            if (field === "Nama") setNamaError(true);
                            if (field === "Jenis") setJenisError(true);
                            if (field === "Umur") setUmurError(true);
                            if (field === "Pekerjaan") setPekerjaanError(true);
                            if (field === "Alamat") setAlamatError(true);
                            if (field === "Telepon") setTeleponError(true);
                            if (field === "Permasalahan") setPermasalahanError(true);
                            if (field === "Solusi") setSolusiError(true);
                            messages.forEach(message => {
                                applicationContext?.openErrorModal(`<b>${field}</b> : ${message}`);
                            })
                        })
                    }
                } else {
                    applicationContext!.showLoading = false;
                    applicationContext?.openErrorModal(`Terjadi kesalahan`);
                }
            }
        }
    }

    useEffect(() => {
        if (props.type === "create") return;

        applicationContext!.showLoading = true;
        fetch(`${getApiHost()}/api/layanan/${id}`, {
            headers: {
                "Accept": "application/json",
                "Authorization": `Bearer ${applicationContext?.token ?? ""}`
            },
            method: "GET",
            credentials: "include"
        }).then(response => {
            if (response.ok) response.json().then((body: LayananResponse) => {
                setLayananResponse(body)
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
    }, [props.type]);

    useEffect(() => {
        if (!layananResponse) return;
        if (nomorRef.current) {
            nomorRef.current.value = layananResponse.nomor ?? 0;
        }
        if (tanggalRef.current) {
            tanggalRef.current.value = layananResponse.tanggal ?? "";
        }
        if (namaRef.current) {
            namaRef.current.value = layananResponse.nama ?? "";
        }
        if (jenisRef.current) {
            jenisRef.current.value = layananResponse.jenis ?? 0;
        }
        if (umurRef.current) {
            umurRef.current.value = layananResponse.umur ?? 0;
        }
        if (pekerjaanRef.current) {
            pekerjaanRef.current.value = layananResponse.pekerjaan ?? "";
        }
        if (alamatRef.current) {
            alamatRef.current.value = layananResponse.alamat ?? "";
        }
        if (teleponRef.current) {
            teleponRef.current.value = layananResponse.telepon ?? "";
        }
        if (pelayananRef.current) {
            pelayananRef.current.checked = layananResponse.isPelayanan ?? false;
        }
        if (ideologiRef.current) {
            ideologiRef.current.checked = layananResponse.isIdeologi ?? false;
        }
        if (politikRef.current) {
            politikRef.current.checked = layananResponse.isPolitik ?? false;
        }
        if (sosialRef.current) {
            sosialRef.current.checked = layananResponse.isSosial ?? false;
        }
        if (budayaRef.current) {
            budayaRef.current.checked = layananResponse.isBudaya ?? false;
        }
        if (agamaRef.current) {
            agamaRef.current.checked = layananResponse.isAgama ?? false;
        }
        if (kamtibmasRef.current) {
            kamtibmasRef.current.checked = layananResponse.isKamtibmas ?? false;
        }
        if (kriminalitasRef.current) {
            kriminalitasRef.current.checked = layananResponse.isKriminalitas ?? false;
        }
        if (tibcarLantasRef.current) {
            tibcarLantasRef.current.checked = layananResponse.isTibcarLantas ?? false;
        }
        if (prilakuPolriRef.current) {
            prilakuPolriRef.current.checked = layananResponse.isPrilakuPolri ?? false;
        }
        if (yanPolriRef.current) {
            yanPolriRef.current.checked = layananResponse.isYanPolri ?? false;
        }
        if (lainLainRef.current) {
            lainLainRef.current.checked = layananResponse.isLainLain ?? false;
        }
        if (permasalahanRef.current) {
            permasalahanRef.current.value = layananResponse.permasalahan ?? "";
        }
        if (solusiRef.current) {
            solusiRef.current.value = layananResponse.solusi ?? "";
        }
    }, [props.type, layananResponse]);

    return (
        <div key={[props.type].join("|")} className={"w-full flex flex-col gap-4 py-4"}>
            {[
                {
                    ref: nomorRef,
                    type: "number",
                    title: "Nomor Kunjungan",
                    error: nomorError,
                    setError: setNomorError,
                    defaultValue: layananResponse?.nomor,
                },
                {
                    ref: tanggalRef,
                    type: "datetime-local",
                    title: "Tanggal dan Waktu",
                    error: tanggalError,
                    setError: setTanggalError,
                    defaultValue: layananResponse?.tanggal,
                },
                {
                    ref: namaRef,
                    type: "text",
                    title: "Nama",
                    error: namaError,
                    setError: setNamaError,
                    defaultValue: layananResponse?.nama,
                },
                {
                    ref: jenisRef,
                    type: "select",
                    title: "Jenis Kelamin",
                    error: jenisError,
                    options: [{value: "1", label: "Laki-laki"}, {value: "2", label: "Perempuan"}],
                    setError: setJenisError,
                    defaultValue: `${layananResponse?.jenis ?? "#"}`,
                },
                {
                    ref: umurRef,
                    type: "number",
                    title: "Umur",
                    error: umurError,
                    setError: setUmurError,
                    defaultValue: layananResponse?.umur,
                },
                {
                    ref: pekerjaanRef,
                    type: "text",
                    title: "Pekerjaan",
                    error: pekerjaanError,
                    setError: setPekerjaanError,
                    defaultValue: layananResponse?.pekerjaan,
                },
                {
                    ref: alamatRef,
                    type: "text",
                    title: "Alamat",
                    error: alamatError,
                    setError: setAlamatError,
                    defaultValue: layananResponse?.alamat,
                },
                {
                    ref: teleponRef,
                    type: "number",
                    title: "Telepon",
                    error: teleponError,
                    setError: setTeleponError,
                    defaultValue: layananResponse?.telepon,
                },
                {
                    type: "aspek",
                    title: "Aspek",
                },
                {
                    ref: permasalahanRef,
                    type: "area",
                    title: "Permasalahan Kesehatan / Informasi / Saran / Keluhan Masyarakat",
                    error: permasalahanError,
                    setError: setPermasalahanError,
                    defaultValue: layananResponse?.permasalahan,
                },
                {
                    ref: solusiRef,
                    type: "area",
                    title: "Solusi Permasalahan Kesehatan / Himbauan / Saran / Tindak Lanjut Petugas Polmas Yankes Presisi",
                    error: solusiError,
                    setError: setSolusiError,
                    defaultValue: layananResponse?.solusi,
                },
                {
                    ref: dokumentasiRef,
                    type: "file",
                    title: "Dokumentasi",
                    error: dokumentasiError,
                    setError: setDokumentasiError,
                    defaultValue: layananResponse?.dokumentasi,
                },
            ].map(e => (
                <div key={e.title} className={"w-full flex flex-col lg:flex-row items-start lg:justify-between"}>
                    <div className={`w-full min-h-10 lg:w-[15rem] py-1.5`}>
                        {e.title}
                    </div>
                    <div className={`w-full min-h-10 lg:w-[calc(100%-1rem-15rem)]`}>
                        {["text", "number", "date", "datetime-local"].includes(e.type) && (
                            <input ref={e.ref}
                                   type={e.type}
                                   className={clsx("duration-150 w-full px-4 h-10 rounded bg-white focus:ring-4", e.error ? "ring-2 ring-red-500" : "border border-neutral-300 focus:ring-red-900")}
                                   placeholder={e.title}
                                   defaultValue={e.defaultValue}
                                   onInput={() => e.setError(false)}
                            />
                        )}
                        {e.type === "select" && (
                            <select ref={e.ref}
                                    className={clsx("duration-150 w-full px-4 h-10 rounded bg-white focus:ring-4", e.error ? "ring-2 ring-red-500" : "border border-neutral-300 focus:ring-red-900")}
                                    defaultValue={e.defaultValue ?? "#"}
                                    onClick={() => e.setError(false)}>
                                <option value={"#"} disabled={true}>Pilih {e.title}</option>
                                {e.options.map(opt => (
                                    <option key={opt.value} value={opt.value}>
                                        {opt.label}
                                    </option>
                                ))}
                            </select>
                        )}
                        {e.type === "area" && (
                            <textarea ref={e.ref}
                                      className={clsx("duration-150 w-full px-4 py-1.5 h-40 rounded bg-white focus:ring-4", e.error ? "ring-2 ring-red-500" : "border border-neutral-300 focus:ring-red-900")}
                                      placeholder={e.title}
                                      onInput={() => e.setError(false)}
                                      defaultValue={e.defaultValue}
                            />
                        )}
                        {e.type === "file" && (
                            <div>
                                <input ref={dokumentasiRef}
                                       type={"file"}
                                       className={"hidden"}
                                       accept={"image/jpeg"}
                                       multiple={false}
                                />
                                <button className={"duration-150 w-40 h-10 rounded bg-teal-500 hover:bg-teal-400 fill-white text-white"} onClick={() => dokumentasiRef.current!.click()}>
                                    <div className={"w-full h-full flex items-center justify-center"}>
                                        <ImageSVG className={"w-6 h-6 fill-inherit"}/>
                                        Upload Gambar
                                    </div>
                                </button>
                            </div>
                        )}
                        {e.type === "aspek" && (
                            <div className={"w-full grid grid-cols-2"}>
                                {[
                                    {
                                        ref: pelayananRef,
                                        type: "checkbox",
                                        title: "Pelayanan Kesehatan",
                                        error: pelayananError,
                                        setError: setPelayananError,
                                        defaultChecked: !!layananResponse && !!layananResponse.isPelayanan,
                                    },
                                    {
                                        ref: kamtibmasRef,
                                        type: "checkbox",
                                        title: "Kamtibmas",
                                        error: kamtibmasError,
                                        setError: setKamtibmasError,
                                        defaultChecked: !!layananResponse && !!layananResponse.isKamtibmas,
                                    },
                                    {
                                        ref: ideologiRef,
                                        type: "checkbox",
                                        title: "Ideologi",
                                        error: ideologiError,
                                        setError: setIdeologiError,
                                        defaultChecked: !!layananResponse && !!layananResponse.isIdeologi,
                                    },
                                    {
                                        ref: kriminalitasRef,
                                        type: "checkbox",
                                        title: "Kriminalitas",
                                        error: kriminalitasError,
                                        setError: setKriminalitasError,
                                        defaultChecked: !!layananResponse && !!layananResponse.isKriminalitas,
                                    },
                                    {
                                        ref: politikRef,
                                        type: "checkbox",
                                        title: "Politik",
                                        error: politikError,
                                        setError: setPolitikError,
                                        defaultChecked: !!layananResponse && !!layananResponse.isPolitik,
                                    },
                                    {
                                        ref: tibcarLantasRef,
                                        type: "checkbox",
                                        title: "Tibcar Lantas",
                                        error: tibcarLantasError,
                                        setError: setTibcarLantasError,
                                        defaultChecked: !!layananResponse && !!layananResponse.isTibcarLantas,
                                    },
                                    {
                                        ref: sosialRef,
                                        type: "checkbox",
                                        title: "Sosial",
                                        error: sosialError,
                                        setError: setSosialError,
                                        defaultChecked: !!layananResponse && !!layananResponse.isSosial,
                                    },
                                    {
                                        ref: prilakuPolriRef,
                                        type: "checkbox",
                                        title: "Prilaku Polri",
                                        error: prilakuPolriError,
                                        setError: setPrilakuPolriError,
                                        defaultChecked: !!layananResponse && !!layananResponse.isPrilakuPolri,
                                    },
                                    {
                                        ref: budayaRef,
                                        type: "checkbox",
                                        title: "Budaya",
                                        error: budayaError,
                                        setError: setBudayaError,
                                        defaultChecked: !!layananResponse && !!layananResponse.isBudaya,
                                    },
                                    {
                                        ref: yanPolriRef,
                                        type: "checkbox",
                                        title: "Yan Polri",
                                        error: yanPolriError,
                                        setError: setYanPolriError,
                                        defaultChecked: !!layananResponse && !!layananResponse.isYanPolri,
                                    },
                                    {
                                        ref: agamaRef,
                                        type: "checkbox",
                                        title: "Agama",
                                        error: agamaError,
                                        setError: setAgamaError,
                                        defaultChecked: !!layananResponse && !!layananResponse.isAgama,
                                    },
                                    {
                                        ref: lainLainRef,
                                        type: "checkbox",
                                        title: "Lain-Lain",
                                        error: lainLainError,
                                        setError: setLainLainError,
                                        defaultChecked: !!layananResponse && !!layananResponse.isLainLain,
                                    },
                                ].map(c => (
                                    <Fragment key={c.title}>
                                        {c.type == "checkbox" && (
                                            <div className={"w-full h-10 flex items-center gap-2"}>
                                                <input ref={c.ref}
                                                       type={"checkbox"}
                                                       className={"accent-red-900"}
                                                       defaultChecked={c.defaultChecked}
                                                />
                                                <button className={"h-full"} onClick={() => c.ref.current.checked = !c.ref.current.checked}>
                                                    {c.title}
                                                </button>
                                            </div>
                                        )}
                                    </Fragment>
                                ))}
                            </div>
                        )}
                    </div>
                </div>
            ))}
            <div className={"w-full flex flex-col lg:flex-row items-start lg:justify-between"}>
                <div className={`w-full min-h-10 lg:w-[15rem] py-1.5`}/>
                <div className={`w-full min-h-10 lg:w-[calc(100%-1rem-15rem)] flex items-center gap-2`}>
                    <button className={"w-24 h-10 rounded duration-150 bg-red-900 focus:ring-4 focus:ring-red-700 hover:bg-red-800 text-white"} onClick={handleSubmit}>
                        Simpan
                    </button>
                    <Link to={"/"}>
                        <button className={"w-24 h-10 rounded duration-150 bg-neutral-500 hover:bg-neutral-400 focus:ring-4 focus:ring-neutral-700 text-white"}>
                            Kembali
                        </button>
                    </Link>
                </div>
            </div>
        </div>
    );

}