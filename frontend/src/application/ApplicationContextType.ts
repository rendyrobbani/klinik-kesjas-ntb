export type ApplicationContextType = {
    token: () => null | string;
    showLoading: boolean;
    setModalTop: (value: number) => void;
    openInfoModal: (message: string) => void;
    openErrorModal: (message: string) => void;
    openSuccessModal: (message: string) => void;
    openWarningModal: (message: string) => void;
}