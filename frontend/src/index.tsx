import {createRoot} from "react-dom/client";
import {StrictMode} from "react";
import {Application} from "./application/Application.tsx";
import "./index.css";
import {setApiHost} from "./hook/config.ts";

setApiHost("http://localhost:8080");
setApiHost(window.location.origin);

const container = document.getElementById("root");
if (!!container) {
    createRoot(container).render(
        <StrictMode>
            <Application/>
        </StrictMode>
    );
}