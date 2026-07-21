import {Outlet, useNavigate} from "react-router-dom";
import logoKesjas from "../../assets/logo-kesjas.png";
import {useApplicationContext} from "../../hook/useApplicationContext.tsx";
import LogoutSVG from "../../assets/logout.svg?react";

export const Dashboard = () => {

    const applicationContext = useApplicationContext();
    const navigate = useNavigate();

    const handleLogout = () => {
        applicationContext!.token = null;
        navigate("/login")
    }

    return (
        <div className={"w-full h-full"}>
            <div className={"w-full h-20 flex items-center bg-red-900"}>
                <div className={"w-1/2 px-4 flex items-center justify-start gap-4"}>
                    <div>
                        <img src={logoKesjas} alt={"#"} className={"w-10"}/>
                    </div>
                    <div className={"text-white font-medium text-xl"}>
                        POLMAS SAT BRIMOB POLDA NTB
                    </div>
                </div>
                <div className={"w-1/2 px-4 flex items-center justify-end"}>
                    <button className={"duration-150 rounded w-6 h-6 fill-red-950 hover:fill-white"} onClick={handleLogout}>
                        <LogoutSVG className={"w-6 h-6 fill-inherit"}/>
                    </button>
                </div>
            </div>
            <div className={"w-full px-8 h-[calc(100%-5rem)] bg-white overflow-auto"}>
                <Outlet/>
            </div>
        </div>
    );

}