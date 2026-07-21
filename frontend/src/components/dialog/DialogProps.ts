import {type MouseEvent, type ReactNode} from "react";

export type DialogProps = {
	children?: ReactNode;
	handleReject?: null | ((e: MouseEvent<HTMLButtonElement>) => void | Promise<void>);
	zIndex?: number;
}