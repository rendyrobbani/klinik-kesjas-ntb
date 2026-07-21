/* eslint-disable */
declare module '*.svg?react' {
    import * as React from 'react';
    const ReactComponent: React.FC<React.SVGProps<SVGSVGElement> & {title?: string}>;
    export default ReactComponent;
}

declare module "*.json" {
    const value: any
    export default value
}