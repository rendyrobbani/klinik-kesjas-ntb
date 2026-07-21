import {createContext} from "react";
import type {ApplicationContextType} from "./ApplicationContextType";

export const ApplicationContext = createContext<null | ApplicationContextType>(null);