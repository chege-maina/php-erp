<v-dialog v-model="dialog" persistent max-width="600px">
  <template v-slot:activator="{ on, attrs }">
    <v-btn color="primary" dark v-bind="attrs" v-on="on">
      Open Dialog
    </v-btn>
  </template>
  <!--
  <v-card style="background-color: #121E2D00;">
-->
  <v-card>
    <v-card-title>
      <span class="headline">Chart of Accounts</span>
    </v-card-title>
    <v-card-text>
      <v-container>
        <v-row>
          <v-col cols="12">
            <v-text-field label="Head Name"></v-text-field>
          </v-col>
          <v-col cols="12" sm="6" md="6">
            <v-text-field label="Head Code*" required></v-text-field>
          </v-col>
          <v-col cols="12" sm="6" md="6">
            <v-text-field label="Head Level*" required></v-text-field>
          </v-col>
          <v-col cols="12">
            <v-text-field label="Account Type*" required></v-text-field>
          </v-col>
          <v-col cols="12">
            <v-text-field label="Carrying Forward*" type="password" required></v-text-field>
          </v-col>
        </v-row>
      </v-container>
      <small>*indicates required field</small>
    </v-card-text>
    <v-card-actions>
      <v-spacer></v-spacer>
      <v-btn color="blue darken-1" text @click="dialog = false">
        Close
      </v-btn>
      <v-btn color="blue darken-1" text @click="dialog = false">
        Save
      </v-btn>
    </v-card-actions>
  </v-card>
</v-dialog>
