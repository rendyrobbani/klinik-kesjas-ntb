import {forwardRef, useImperativeHandle, useState} from "react";
import type {DialogProps} from "./DialogProps";
import type {DialogRef} from "./DialogRef";

export const DialogRoot = forwardRef<DialogRef, DialogProps>((props, ref) => {

	const transitionDelay = 50;
	const transitionDuration = 200;

	const [opacity, setOpacity] = useState(0);
	const [display, setDisplay] = useState("none");

	const wait = (ms: number) =>
		new Promise<void>(resolve => setTimeout(resolve, ms));

	const show = async (): Promise<void> => {
		setDisplay("block");
		await wait(transitionDelay);
		setOpacity(1);
		await wait(transitionDuration);
		await wait(transitionDelay);
	};

	const hide = async (): Promise<void> => {
		await wait(transitionDelay);
		setOpacity(0);
		await wait(transitionDuration);
		setDisplay("none");
		await wait(transitionDelay);
	};

	useImperativeHandle(ref, () => ({
		show,
		hide,
	}));

	return (
		<div className={"w-full h-screen fixed inset-0 flex items-center justify-center transition-all ease-in-out"} style={{display, zIndex: props.zIndex ?? 998}}>
			<div className={"ease-in-out"} style={{transitionDelay: `${transitionDelay}ms`, transitionDuration: `${transitionDuration}ms`, opacity}}>
				<div className={"w-full h-full bg-black/50 absolute transition-all"}>
					<div className={"flex justify-center ease-in-out"} style={{transitionDelay: `${transitionDelay}ms`, transitionDuration: `${transitionDuration}ms`, opacity}}>
						{props.children}
					</div>
				</div>
			</div>
		</div>
	);

});