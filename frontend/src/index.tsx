import {createRoot} from "react-dom/client";
import {StrictMode} from "react";
import {Application} from "./application/Application.tsx";
import "./index.css";

const container = document.getElementById("root");
if (!!container) {
    createRoot(container).render(
        <StrictMode>
            <Application/>
        </StrictMode>
    );
}