import {createBrowserRouter, RouterProvider} from "react-router-dom";
import {LoginPage} from "../pages/login/LoginPage.tsx";
import {ApplicationContext} from "./ApplicationContext.tsx";
import {type ReactNode, useState} from "react";
import {ModalType} from "../components/modal/ModalType.tsx";
import {Modal} from "../components/modal/Modal.tsx";
import type {ApplicationContextType} from "./ApplicationContextType.ts";
import ProgressActivitySVG from "../assets/progress_activity.svg?react"
import NotFound from "../pages/error/NotFound.tsx";
import {SelectPage} from "../pages/select/SelectPage.tsx";

export const Application = () => {

    const [modalTop, setModalTop] = useState(0);
    const [modals, setModals] = useState<Record<string, ReactNode>>({});

    const [showLoading, setShowLoading] = useState(false);

    const token = (): null | string => {
        try {
            return (document.cookie.split(";").filter(c => c.trim().toLowerCase().startsWith("x-auth-token"))[0] ?? "").split("=")[1];
        } catch {
            return null;
        }
    }

    const closeModal = (uuid: string) => {
        setModals(from => {
            const {[uuid]: _, ...into} = from;
            return into;
        });
    }

    const openModal = (type: number, message: string) => {
        const uuid = Math.random().toString(36).slice(2);
        setModals(from => ({
            ...from,
            [uuid]: <Modal key={uuid} uuid={uuid} type={type} message={message} dispose={() => closeModal(uuid)}/>,
        }));
    }

    const openInfoModal = (message: string) => openModal(ModalType.INFO, message);

    const openErrorModal = (message: string) => openModal(ModalType.ERROR, message);

    const openSuccessModal = (message: string) => openModal(ModalType.SUCCESS, message);

    const openWarningModal = (message: string) => openModal(ModalType.WARNING, message);

    const applicationContext = (): ApplicationContextType => ({
        token,
        set showLoading(value: boolean) {
            setShowLoading(value);
        },
        get showLoading() {
            return showLoading;
        },
        setModalTop,
        openInfoModal,
        openErrorModal,
        openSuccessModal,
        openWarningModal,
    });

    return (
        <ApplicationContext.Provider value={applicationContext()}>
            <div className={"w-full h-screen bg-neutral-900 border-x border-b border-neutral-900"}>
                <RouterProvider router={createBrowserRouter([
                    {
                        path: "/login",
                        element: <LoginPage/>,
                    },
                    {
                        path: "/",
                        element: <SelectPage/>,
                    },
                    {
                        path: "*",
                        element: <NotFound/>,
                    }
                ])}
                >

                </RouterProvider>
            </div>
            <div className={"fixed z-800 right-0 flex flex-col items-end justify-start gap-1"} style={{top: modalTop + "rem"}}>
                {Object.values(modals).map(modal => modal)}
            </div>
            {showLoading && (
                <div className={"fixed inset-0 z-900 w-full h-screen flex items-center justify-center bg-black/50"}>
                    <ProgressActivitySVG className={"w-40 h-40 fill-red-500 animate-spin"}/>
                </div>
            )}
        </ApplicationContext.Provider>
    );

}