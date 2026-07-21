import type {ReactNode} from "react";

export type ApplicationContextType = {
    token: undefined | null | string;
    showLoading: boolean;
    setModalTop: (value: number) => void;
    openInfoModal: (message: string) => void;
    openErrorModal: (message: string) => void;
    openSuccessModal: (message: string) => void;
    openWarningModal: (message: string) => void;
    hideDialog: () => Promise<void>;
    showDialog: () => Promise<void>;
    closeDialog: () => Promise<void>;
    openDialog: (content: ReactNode) => Promise<void>;
}