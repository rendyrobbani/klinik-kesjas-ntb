import {forwardRef, type ReactNode, useEffect, useImperativeHandle, useState} from "react";
import ChevronLeftSVG from "../../assets/chevron_left.svg?react";
import ChevronRightSVG from "../../assets/chevron_right.svg?react";
import FirstPageSVG from "../../assets/first_page.svg?react";
import LastPageSVG from "../../assets/last_page.svg?react";
import type {PageNumberProps} from "./PageNumberProps";
import type {PageNumberRef} from "./PageNumberRef";

export const PageNumber = forwardRef<PageNumberRef, PageNumberProps>((props, ref) => {

	const [value, setValue] = useState(props.defaultValue ?? 0);
	const [total, setTotal] = useState(props.defaultTotal ?? 0);
	const [count, setCount] = useState(props.defaultCount ?? 5);

	useEffect(() => {
		setValue(props.defaultValue ?? 0);
	}, [props.defaultValue]);

	useEffect(() => {
		setTotal(props.defaultTotal ?? 0);
	}, [props.defaultTotal]);

	useEffect(() => {
		setCount(props.defaultCount ?? 5);
	}, [props.defaultCount]);

	useImperativeHandle(ref, () => ({
		set value(v: number) {
			setValue(Math.max(1, Math.min(100, v ?? 0)));
		},
		get value() {
			return value ?? 0;
		},
		set total(v: number) {
			setTotal(Math.max(1, Math.min(100, v ?? 0)));
		},
		get total() {
			return total ?? 0;
		},
		set count(v: number) {
			setCount(v ?? 0);
		},
		get count() {
			return count ?? 0;
		},
	}));

	const button = (key: string, page: number, children: ReactNode, disabled: boolean) => (
		<button key={key}
		        className={"w-10 h-10 flex items-center justify-center ring-1 rounded transition bg-white disabled:bg-slate-200 hover:bg-red-900 ring-slate-300 disabled:ring-slate-300 hover:ring-red-900 fill-slate-700 disabled:fill-slate-400 hover:fill-white text-slate-700 disabled:text-slate-400 hover:text-white"}
		        onClick={() => {
			        if (!!props.onClick) props.onClick(Math.max(1, Math.min(100, page)));
		        }}
		        disabled={disabled}
		>
			{children}
		</button>
	);

	const first = () => button("f", 1, <FirstPageSVG className={"fill-inherit w-6 h-6"}/>, value <= 1 || total <= 1);
	const prev = () => button("p", Math.max(value - 1, 1), <ChevronLeftSVG className={"fill-inherit w-6 h-6"}/>, value <= 1 || total <= 1);
	const next = () => button("n", Math.min(value + 1, total), <ChevronRightSVG className={"fill-inherit w-6 h-6"}/>, value >= total);
	const last = () => button("l", total, <LastPageSVG className={"fill-inherit w-6 h-6"}/>, value >= total);

	const listNumber = (page: number, total: number, width: number): number[] => {
		const half = Math.floor(width / 2);

		let s = page - half;
		let e = page + half;

		if (s < 1) {
			s = 1;
			e = Math.min(total, s + width - 1);
		}

		if (e > total) {
			e = total;
			s = Math.max(1, e - width + 1);
		}

		const pages: number[] = [];
		for (let i = s; i <= e; i++) pages.push(i);

		return pages;
	}

	return (
		<div className={"flex items-center justify-center gap-2"}>
			{!!value && first()}
			{!!value && prev()}
			{!!value && listNumber(value, total, count).map(page => button(`n${page}`, page, page, page == value))}
			{!!value && next()}
			{!!value && last()}
		</div>
	);

})