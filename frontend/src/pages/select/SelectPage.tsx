import { useNavigate } from "react-router-dom";
import {useApplicationContext} from "../../hook/useApplicationContext.tsx";
import {useEffect} from "react";

export const SelectPage = () => {

    const applicationContext = useApplicationContext();

    const navigate = useNavigate();

    useEffect(() => {
        const token = applicationContext?.token() ?? null;
        if (token == null) navigate("/login");
    }, []);

    return (
        <div className={"text-white"}>
            Beranda
        </div>
    );

}