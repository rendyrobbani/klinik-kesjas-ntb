import {type InputEvent, useEffect, useRef, useState} from "react";
import logoPolri from "../../assets/logo-polri.png";
import logoKesjas from "../../assets/logo-kesjas.png";
import LoginSVG from "../../assets/login.svg?react";
import ProgressActivitySVG from "../../assets/progress_activity.svg?react";
import {useApplicationContext} from "../../hook/useApplicationContext.tsx";

export const LoginPage = () => {

    const applicationContext = useApplicationContext();

    const usernameRef = useRef<null | HTMLInputElement>(null);
    const passwordRef = useRef<null | HTMLInputElement>(null);
    const checkboxRef = useRef<null | HTMLInputElement>(null);

    const [showPassword, setShowPassword] = useState(false);
    const [showLoading, setShowLoading] = useState(false);

    const usernameInput = (e: InputEvent<HTMLInputElement>) => {
        let value = e.currentTarget.value.replace(/[^0-9]/g, "");
        if (value.length > 8) value = value.substring(0, 8);
        e.currentTarget.value = value;
    }

    const handleSubmit = async () => {
        setShowLoading(true);

        try {
            const url = "http://localhost:8080/api/login"
            const opt = {
                method: "POST",
                body: JSON.stringify({
                    username: usernameRef.current?.value,
                    password: passwordRef.current?.value,
                })
            }
            const response = await fetch(url, opt);
            if (response.ok) {
            } else {
                const body: Record<string, string[]> = await response.json();
                if (!!body) {
                    Object.entries(body).forEach(([field, messages]) => {
                        messages.forEach(message => {
                            applicationContext?.openErrorModal(`<b>${field}</b> : ${message}`);
                        })
                    })
                }
            }
        } catch {
            setShowLoading(false);
        } finally {
            setShowLoading(false);
        }
    }

    useEffect(() => {
        if (!checkboxRef.current) return;
        checkboxRef.current.checked = showPassword;
    }, [showPassword]);

    return (
        <div className={"w-full h-full flex items-center justify-center"}>
            <div className={"w-1/2 h-full hidden lg:flex items-center justify-center bg-red-900"}>
                <div className={"flex flex-col items-center justify-center"}>
                    <div className={"flex items-center justify-center gap-12"}>
                        <img src={logoPolri} alt={"#"} className={"w-40"}/>
                        <img src={logoKesjas} alt={"#"} className={"w-32"}/>
                    </div>
                    <div className={"text-white text-xl mt-4"}>
                        Selamat Datang di
                    </div>
                    <div className={"text-white font-medium text-4xl"}>
                        POLMAS SAT BRIMOB
                    </div>
                    <div className={"text-white font-medium text-2xl"}>
                        POLDA NTB
                    </div>
                </div>
            </div>
            <div className={"w-full lg:w-1/2 h-full flex items-center justify-center bg-neutral-900"}>
                <div className={"w-80 flex flex-col gap-8"}>
                    <div className={"lg:hidden flex flex-col items-center justify-center"}>
                        <div className={"flex items-center justify-center gap-8"}>
                            <img src={logoPolri} alt={"#"} className={"w-20"}/>
                            <img src={logoKesjas} alt={"#"} className={"w-16"}/>
                        </div>
                        <div className={"text-white text-sm mt-4"}>
                            Selamat Datang di
                        </div>
                        <div className={"text-white text-lg font-medium"}>
                            POLMAS SAT BRIMOB POLDA NTB
                        </div>
                    </div>
                    <div className={"flex flex-col"}>
                        <div className={"text-white text-xl font-medium"}>
                            Masuk ke Akun
                        </div>
                        <div className={"text-white"}>
                            Silahkan masukkan detail akun Anda
                        </div>
                    </div>
                    <div className={"w-full flex flex-col items-center justify-center gap-4"}>
                        <input ref={usernameRef}
                               className={"outline-0 rounded duration-150 w-full h-10 px-4 bg-neutral-500 focus:bg-white text-center focus:ring-4 focus:ring-red-700"}
                               type={"text"}
                               placeholder={"Nomor Registrasi Pokok"}
                               readOnly={true}
                               onFocus={e => {
                                   e.currentTarget.readOnly = false
                               }}
                               onKeyDown={e => {
                                   if (e.key === "Enter") handleSubmit();
                               }}
                               onInput={usernameInput}
                        />
                        <input ref={passwordRef}
                               className={"outline-0 rounded duration-150 w-full h-10 px-4 bg-neutral-500 focus:bg-white text-center focus:ring-4 focus:ring-red-700"}
                               type={showPassword ? "text" : "password"}
                               placeholder={"Password"}
                               onFocus={e => {
                                   e.currentTarget.readOnly = false
                               }}
                               onKeyDown={e => {
                                   if (e.key === "Enter") handleSubmit();
                               }}
                               readOnly={true}
                        />
                        <div className={"flex items-center gap-2"}>
                            <input ref={checkboxRef}
                                   className={"outline-0 rounded duration-150 cursor-pointer w-4 h-4 px-4 bg-neutral-800 focus:bg-white accent-red-700"}
                                   type={"checkbox"}
                            />
                            <button className={"text-white cursor-pointer"} onClick={() => setShowPassword(v => !v)}>
                                Lihat Password
                            </button>
                        </div>
                    </div>
                    <div className={"w-full flex flex-col gap-4"}>
                        <button className={"outline-0 rounded duration-150 cursor-pointer w-full h-12 bg-red-700 hover:bg-red-500 text-white fill-white"}
                                onClick={handleSubmit}>
                            <div className={"w-full h-full flex items-center justify-center gap-1"}>
                                <div>
                                    {showLoading && <ProgressActivitySVG className={"w-5 h-5 fill-inherit animate-spin"}/>}
                                    {!showLoading && <LoginSVG className={"w-5 h-5 fill-inherit"}/>}
                                </div>
                                <div className={"font-medium"}>
                                    Masuk
                                </div>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    );

}