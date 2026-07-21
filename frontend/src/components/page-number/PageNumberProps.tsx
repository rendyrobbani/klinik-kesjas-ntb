export type PageNumberProps = {
	defaultValue?: number,
	defaultTotal?: number,
	defaultCount?: number,
	onClick?: (value: number) => void | Promise<void>,
};