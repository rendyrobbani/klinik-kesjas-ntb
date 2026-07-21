import {useEffect, useRef, useState} from "react";
import clsx from "clsx";
import CloseSVG from "../../assets/close.svg?react";
import type {ModalProps} from "./ModalProps";
import {ModalType} from "./ModalType";

const DISPOSE_TIME = 3000;
const DISPOSE_INTV = 500;

export const Modal = (props: ModalProps) => {

	const [opacity, setOpacity] = useState(0);
	const [, setDispose] = useState(DISPOSE_TIME);

	const isMounted = useRef(false);

	const wait = (ms: number) => new Promise<void>(resolve => setTimeout(resolve, ms));

	const close = async () => {
		setOpacity(0);
		await wait(150);
		if (!!props.dispose) props.dispose();
	}

	const run = async () => {
		setOpacity(1);
		await wait(150);
		const intv = setInterval(() => {
			setDispose(v => {
				if (v <= DISPOSE_INTV) {
					clearInterval(intv);
					close().then();
					return 0;
				}
				return v - DISPOSE_INTV;
			})
		}, DISPOSE_INTV);
	}

	useEffect(() => {
		if (isMounted.current) return;
		isMounted.current = true;
		run().then();
	}, []);

	return (
		<div data-uuid={props.uuid}
		     className={clsx(
			     "w-fit h-10 flex items-center justify-end pl-4 rounded-l-lg gap-4 transition-all duration-150 ease-in-out",
			     props.type === ModalType.INFO && "bg-blue-300 text-blue-800",
			     props.type === ModalType.ERROR && "bg-red-300 text-red-800",
			     props.type === ModalType.SUCCESS && "bg-green-300 text-teal-800",
			     props.type === ModalType.WARNING && "bg-yellow-300 text-yellow-800",
		     )}
		     style={{opacity}}
		     onMouseOver={() => setDispose(DISPOSE_TIME)}
		>
			<div dangerouslySetInnerHTML={{__html: props.message}}/>
			<div className={"flex items-center justify-center"}>
				<button onClick={close} className={clsx("w-8 h-6 flex items-center justify-center transition border-l",
					props.type === ModalType.INFO && "fill-blue-800 border-blue-800",
					props.type === ModalType.ERROR && "fill-red-800 border-red-800",
					props.type === ModalType.SUCCESS && "fill-green-800 border-green-800",
					props.type === ModalType.WARNING && "fill-yellow-800 border-yellow-800",
				)}>
					<CloseSVG className={"w-6 h-6 fill-inherit"}/>
				</button>
			</div>
		</div>
	);

}