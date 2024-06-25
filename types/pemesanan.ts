export type Pemesanan = {
  id: number
  user_id: number
  pemesanan: string
  detail_pemesanan: string
  tanggal_pemesanan: string
  unit: number
  created_at: string
  updated_at: string
  pemesan: string;
}

export type Barang = {
  id: number
  kode_barang: string
  nama_barang: string
  harga_jual: number
  stok_barang: number
  created_at: string
  updated_at: string
}
