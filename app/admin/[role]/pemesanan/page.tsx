import ECommerce from "@/components/dashboard/Dashboard/E-commerce";
import Pelatihan from "@/components/dashboard/Dashboard/Pelatihan";
import DefaultLayout from "@/components/dashboard/Layouts/DefaultLayout";
import { Metadata } from "next";

export const metadata: Metadata = {
  title: "Data Pemesanan - Sistem Manajemen Pemesanan Fajar Teknika",
};

export default function Home() {
  return (
    <>
      <DefaultLayout>
        <Pelatihan />
      </DefaultLayout>
    </>
  );
}
