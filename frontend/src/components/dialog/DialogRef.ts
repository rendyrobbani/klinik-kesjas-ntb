export type DialogRef = {
	show: () => Promise<void>;
	hide: () => Promise<void>;
}