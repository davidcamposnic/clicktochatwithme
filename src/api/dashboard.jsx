import axios from "axios";

export class Dashboard {
  async createName(data) {
    axios.defaults.headers.common["X-WP-Nonce"] = clickToChatData.nonce;

    const dataFormatted = {
      data,
    };

    try {
      const response = await axios.post(
        `${clickToChatData.root_url}/wp-json/clicktochat/v1/dashboard/`,
        dataFormatted
      );
      return response;
    } catch (error) {
      throw error;
    }
  }
  async getName() {
    try {
      const response = await axios.get(
        `${clickToChatData.root_url}/wp-json/clicktochat/v1/dashboard/`
      );
      return response;
    } catch (error) {
      throw error;
    }
  }
}
