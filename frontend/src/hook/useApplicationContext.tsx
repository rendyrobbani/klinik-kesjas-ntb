import {useContext} from "react";
import {ApplicationContext} from "../application/ApplicationContext.tsx";

export const useApplicationContext = () => useContext(ApplicationContext);