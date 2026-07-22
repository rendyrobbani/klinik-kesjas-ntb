let apiHost: string = window.location.origin;

export const setApiHost = (host: string) => {
    apiHost = host;
}

export const getApiHost = (): string => apiHost;