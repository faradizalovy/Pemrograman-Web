async function muatData(url) {
    try {
        const res = await fetch(url);

        if (!res.ok) {
            throw new Error("Gagal mengambil data (status " + res.status + ")");
        }

        const data = await res.json();
        return data;
    } catch (err) {
        console.error(err);
        return [];
    }
}