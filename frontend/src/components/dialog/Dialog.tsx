import {type ReactNode} from "react";
import clsx from "clsx";
import CloseSVG from "../../assets/close.svg?react";

export const Dialog = ({title, children, handleReject}: {title: string, children?: ReactNode, handleReject?: null | (() => void | Promise<void>)}) => (
	<div className={"px-8 bg-white absolute rounded overflow-hidden transition-all top-10 max-w-full"}>
		<div className={clsx("w-full flex items-center justify-between", !!handleReject ? "min-h-14" : "min-h-14")}>
			<div className={"font-medium flex items-center text-lg"}>
				{title}
			</div>
			<div>
				{!!handleReject && (
					<button className={"w-6 h-6 flex items-center justify-center transition fill-slate-500 hover:fill-slate-800"} onClick={handleReject}>
						<CloseSVG className={"fill-inherit"}/>
					</button>
				)}
			</div>
		</div>
		{children}
	</div>
);