import React from "react";

interface NotFoundProps {
    onGoHome?: () => void;
}

export const NotFound: React.FC<NotFoundProps> = ({onGoHome}) => {
    const handleGoHome = () => {
        if (onGoHome) {
            onGoHome();
        } else {
            window.location.href = "/";
        }
    };

    return (
        <main
            className="min-h-screen flex items-center justify-center p-6 text-white"
            style={{backgroundColor: "oklch(20.5% 0 none)"}}
        >
            <div className="max-w-md w-full text-center space-y-6">
                {/* Visual / Angka 404 */}
                <div className="relative flex justify-center items-center">
          <span
              className="text-9xl font-extrabold tracking-widest opacity-20 select-none"
              style={{color: "oklch(39.6% 0.141 25.723)"}}
          >
            404
          </span>
                    <div className="absolute inset-0 flex items-center justify-center">
            <span
                className="text-3xl font-bold px-4 py-1 rounded-md shadow-lg"
                style={{
                    backgroundColor: "oklch(39.6% 0.141 25.723)",
                    color: "#ffffff"
                }}
            >
              Halaman Tidak Ditemukan
            </span>
                    </div>
                </div>

                {/* Deskripsi */}
                <div className="space-y-2">
                    <h1 className="text-2xl font-bold tracking-tight sm:text-3xl">
                        Ops! Kamu Tersesat?
                    </h1>
                    <p className="text-sm text-gray-400">
                        Halaman yang kamu cari mungkin telah dipindahkan, dihapus, atau tidak pernah ada.
                    </p>
                </div>

                {/* Akses Cepat / Tombol Aksi */}
                <div className="pt-4 flex flex-col sm:flex-row gap-3 justify-center">
                    <button
                        onClick={handleGoHome}
                        className="px-6 py-3 rounded-lg font-medium transition-all duration-200 hover:opacity-90 active:scale-95 shadow-md"
                        style={{backgroundColor: "oklch(39.6% 0.141 25.723)", color: "#ffffff"}}
                    >
                        Kembali ke Beranda
                    </button>

                    <button
                        onClick={() => window.history.back()}
                        className="px-6 py-3 rounded-lg font-medium border border-gray-700 hover:bg-white/5 transition-all duration-200 active:scale-95 text-gray-300"
                    >
                        Halaman Sebelumnya
                    </button>
                </div>
            </div>
        </main>
    );
};

export default NotFound;